<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Hall;
use App\Models\HallResident;

use Illuminate\Support\Str;

class Admin_HallResidentController extends Controller
{
    //
    public function create(Hall $hall)
    {
        return view('admin.hall_residents.create', compact('hall'));
    }

    public function store(Request $request, Hall $hall)
    {
        $formFields = $request->validate([
            'matric_no' => 'required|string',
            'fullname' => 'required|string',
        ]);

        $alreadyExist = HallResident::where('hall_id', $hall->id)
                                    ->where('matric_no', $request->matric_no)
                                    ->exists();
        if ($alreadyExist)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The Hall Resident record already exist'
            ];
            return redirect()->back()->with($data)->withInput();
        }

        $uuid = Str::orderedUuid();

        $formFields['uuid'] = $uuid;
        $formFields['hall_id'] = $hall->id;


        try
        {
            $create = HallResident::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Hall Resident has been succesfully added'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred adding the Hall Resident'
                ];
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->route('admin.halls.show', ['hall' => $hall->id]);
       
    }

    public function edit(HallResident $resident)
    {
        return view('admin.hall_residents.edit', compact('resident'));
    }

    public function update(Request $request, HallResident $resident)
    {
        $formFields = $request->validate([
            'matric_no' => 'required|string',
            'fullname' => 'required|string'
        ]);

        try
        {
            $update = $resident->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Hall Resident has been succesfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Hall Resident'
                ];
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->route('admin.halls.show', ['hall' => $resident->hall->id]);

    }


    public function delete_hall_residents(HallResident $hall)
    {
    
        $hall_residents = HallResident::where('hall_id', $hall->id)->delete();

        return redirect()->back();
    }

    public function destroy(HallResident $resident)
    {
        $resident->delete();

        return redirect()->route('admin.halls.show', ['hall' => $resident->hall->id]);
    }
}
