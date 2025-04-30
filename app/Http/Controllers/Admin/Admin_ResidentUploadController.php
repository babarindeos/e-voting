<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hall;

use App\Models\TempUpload;
use App\Models\FailUpload;
use App\Models\HallResident;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;



class Admin_ResidentUploadController extends Controller
{
    //
    public function select_file(Request $request, Hall $hall)
    {
        $temp_upload = TempUpload::get();
        $failuploads = FailUpload::get();
        return view('admin.hall_residents.select_upload_file', compact('temp_upload', 'failuploads', 'hall'));
    }


    public function upload(Request $request, Hall $hall)
    {

        $request->validate([
            'document' => 'required|file|mimes:csv,txt|max:5048',
        ]);

        // Read the CSV document file
        $file = $request->file('document');

        $filePath = $file->getRealPath();
        $data = array_map('str_getcsv', file($filePath));

        
        if (count($data) > 0)
        {
            $header = ["matric_no", "fullname", "uuid", "hall_id"];

            $formFields = array();
            $failedRecords = array();

            foreach($data as $row)
            {
                
                $uuid = Str::orderedUuid();

                array_push($row,  $uuid);
                array_push($row, $hall->id);


                $row = array_combine($header, $row);
                $doc_matric_no = $row['matric_no'];


                // get the student record using matric_no and hall id
                $student = HallResident::where('matric_no', $doc_matric_no)
                                  ->where('hall_id', $hall->id)
                                  ->first();


               

                $student_data = [
                    'uuid' => $uuid,
                    'hall_id' => $hall->id,
                    'matric_no' => $row['matric_no'],
                    'fullname' => $row['fullname']                
                ];

                

                if ($student == null)
                {           
                    array_push($formFields, $student_data);

                }
                else
                {
                    array_push($failedRecords, $student_data);
                }
            }

            

            // Record the failed transactions
            FailUpload::truncate();
            foreach($failedRecords as $fail)
            {
                FailUpload::create($fail);
            }


            // Create a transaction and insert the operation data into the database

            DB::beginTransaction();

            try
            {
                foreach($formFields as $row)
                {
                    TempUpload::create($row);
                    
                }
                DB::commit();
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                
                $data = [
                    'error'=>true,
                    'status' => 'fail',
                    'message' => $e->getMessage()
                ];

                return redirect()->back()->with($data);
            }

            return redirect()->back();
        }
    }


    public function clear_temp_upload()
    {
        FailUpload::truncate();
        tempUpload::truncate();

        return redirect()->back();
    }


    public function save_upload()
    {
            $uploads = TempUpload::get();

            $hall_id = '';

            foreach($uploads as $upload)
            {
                $formFields = [
                    'uuid' => $upload->uuid,
                    'hall_id' => $upload->hall_id,
                    'matric_no' => $upload->matric_no,
                    'fullname' => $upload->fullname                    
                ];

                

                HallResident::create($formFields);
                $hall_id = $upload->hall_id;
            }

            FailUpload::truncate();
            TempUpload::truncate();

            return redirect()->route('admin.halls.show',['hall' => $hall_id]);
    }

    public function destroy(Request $request, TempUpload $upload)
    {
        $upload->delete();

        return redirect()->back();
    }
}
