<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Minute;
use App\Models\Meeting;
use Carbon\Carbon;
use illuminate\Support\Facades\Auth;
use App\Http\Classes\Document;

class Admin_MinuteController extends Controller
{
    //
    public function index()
    {
        $minutes = Minute::orderBy('id', 'desc')->paginate(20);

        return view('admin.minutes.index', compact('minutes'));
    }

    public function create()
    {
        $meetings = Meeting::orderBy('title', 'asc')->get();
        return view('admin.minutes.create', compact('meetings'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);

        $formFields['note'] = $request->note;
        $formFields['meeting_id'] = $request->meeting;
       
        $file = '';
        $fileSize = '';
        $fileType = '';

        try
        {
            if ($request->hasFile('file'))
            {
                $currentDateTime = Carbon::now()->format('Ymd_His');
                $filename = $currentDateTime.'_'.auth()->user()->id;
                $filename = $filename.".";
    
                $file = $request->file('file');
                $fileSize = Document::getDocumentSize($file);
                $fileType = Document::getDocumentType($file);
    
                $new_filename = $filename.$file->getClientOriginalExtension();
    
                $file->storeAs('minutes', $new_filename);    

                $formFields['file'] = 'minutes/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
            }

            
            $formFields['user_id'] = Auth::user()->id;


            $created = Minute::create($formFields);

            if ($created)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Minute has been successfully uploaded'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred uploading the Minute'
                ];

            }    
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred -'.$e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
    }

    public function edit(Minute $minute)
    {
        $meetings = Meeting::orderBy('title', 'asc')->get();
        return view('admin.minutes.edit', compact('meetings', 'minute'));
    }

    public function update(Request $request, Minute $minute)
    {
        $formFields = $request->validate([
            'title' => 'required|string',
        ]);

        $formFields['note'] = $request->note;
        $formFields['meeting_id'] = $request->meeting;
       
        $file = $minute->file;
        $fileSize = $minute->filesize;
        $fileType = $minute->filetype;



        try
        {
            if ($request->hasFile('file'))
            {
                $currentDateTime = Carbon::now()->format('Ymd_His');
                $filename = $currentDateTime.'_'.auth()->user()->id;
                $filename = $filename.".";
    
                $file = $request->file('file');
                $fileSize = Document::getDocumentSize($file);
                $fileType = Document::getDocumentType($file);
    
                $new_filename = $filename.$file->getClientOriginalExtension();
    
                $file->storeAs('minutes', $new_filename);    

                $formFields['file'] = 'minutes/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
            }

            
            $formFields['user_id'] = Auth::user()->id;

         
            $update = $minute->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Minute has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Minute'
                ];

            }    
        }
        catch(\Exception $e)
        {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred -'.$e->getMessage()
                ];
        }

        return redirect()->back()->with($data);
    }

    public function confirm_delete(Minute $minute)
    {
         return view('admin.minutes.confirm_delete', compact('minute'));
    }

    public function destroy(Minute $minute)
    {
        $minute->delete();

        return redirect()->route('admin.minutes.index');
    }
}
