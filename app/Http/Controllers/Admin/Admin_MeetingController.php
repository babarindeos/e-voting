<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use Carbon\Carbon;
use App\Http\Classes\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\MeetingComment;
use App\Models\Agenda;

class Admin_MeetingController extends Controller
{
    //
    public function index()
    {
        $meetings = Meeting::orderBy('id', 'desc')->paginate(20);

        return view('admin.meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('admin.meetings.create');
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            'title' => 'required|string|unique:meetings,title',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'venue' => 'required',            
        ]);

        $formFields['date'] = $request->input('schedule_date');
        $formFields['time'] = $request->input('schedule_time');
        $formFields['message'] = $request->message;
        $formFields['link'] = $request->input('link');
    
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
    
                $file->storeAs('meetings', $new_filename);    

                $formFields['file'] = 'meetings/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
                
            }

           
            $formFields['user_id'] = Auth::user()->id;


            $created = Meeting::create($formFields);

            

            if ($created)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Meeting has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Meeting'
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

    public function edit(Meeting $meeting)
    {
        return view('admin.meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $formFields = $request->validate([
            'title' => 'required|string',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'venue' => 'required',            
        ]);

        $formFields['date'] = $request->input('schedule_date');
        $formFields['time'] = $request->input('schedule_time');
        $formFields['message'] = $request->message;
        $formFields['link'] = $request->input('link');
    
        $file = $meeting->file;
        $fileSize = $meeting->filesize;
        $fileType = $meeting->filetype;

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
    
                $file->storeAs('meetings', $new_filename);    

                $formFields['file'] = 'meetings/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
                
            }

           
            $formFields['user_id'] = Auth::user()->id;


            $update = $meeting->update($formFields);

            

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Meeting has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updated the Meeting'
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

    public function confirm_delete(Meeting $meeting)
    {
        return view('admin.meetings.confirm_delete', compact('meeting'));
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        return redirect()->route('admin.meetings.index');
    }

    public function show(Meeting $meeting)
    {

        $agenda = Agenda::where('meeting_id', $meeting->id)->get();

        $comments = MeetingComment::where('meeting_id', $meeting->id)
                                    ->orderBy('id', 'desc')
                                    ->get();

        return view('admin.meetings.show', compact('meeting', 'comments', 'agenda'));
    }
}
