<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\College;
use App\Models\Department;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Classes\Document;
use App\Models\PaperComment;
use App\Models\Agenda;

class Admin_PaperController extends Controller
{
    //
    public function index()
    {
        $papers = Paper::orderBy('id', 'desc')->paginate(10);
       
        return view('admin.papers.index', compact('papers'));
    }

    public function create()
    {
        $colleges = College::orderBy('name', 'asc')->get();
        $departments = Department::orderBy('name','asc')->get();

        $staff = Staff::orderBy('surname', 'asc')->get();

        return view('admin.papers.create')->with(['colleges'=>$colleges, 'departments'=>$departments, 'staff'=>$staff]);
    }

    public function store(Request $request)
    {

        $formFields = $request->validate([
            'paper_no' => 'required|string|unique:papers,paper_no',
            'title' => 'required|string|unique:papers,title',
            'college' => 'required',
            'author' =>  'required',
            'status' => 'required'
        ]);

        $formFields['college_id'] = $request->college;
        $formFields['department_id'] = $request->department;
        $formFields['other_authors'] = $request->other_authors;
        $formFields['note'] = $request->note;

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
    
                $file->storeAs('papers', $new_filename);    

                $formFields['file'] = 'papers/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
            }

            
            $formFields['user_id'] = Auth::user()->id;


            $created = Paper::create($formFields);

            if ($created)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Paper has been successfully uploaded'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred uploading the Paper'
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

    public function show(Paper $paper)
    {
        $comments = PaperComment::where('paper_id', $paper->id)
                                    ->orderBy('id', 'desc')
                                    ->get();
        return view('admin.papers.show', compact('paper', 'comments'));
    }

    public function edit(Paper $paper)
    {
            $colleges = College::orderBy('name', 'asc')->get();
            $departments = Department::orderBy('name','asc')->get();

            $staff = Staff::orderBy('surname', 'asc')->get();
            return view('admin.papers.edit', compact('paper'))->with(['colleges'=>$colleges, 'departments'=>$departments, 'staff'=>$staff]);;
    }

    public function update(Request $request, Paper $paper)
    {
        $formFields = $request->validate([
            'paper_no' => 'required|string',
            'title' => 'required|string',
            'college' => 'required',
            'author' =>  'required',
            'status' => 'required'
        ]);

        $formFields['college_id'] = $request->college;
        $formFields['department_id'] = $request->department;
        $formFields['other_authors'] = $request->other_authors;
        $formFields['note'] = $request->note;

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
    
                $file->storeAs('papers', $new_filename);    

                $formFields['file'] = 'papers/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
            }

            
            $formFields['user_id'] = Auth::user()->id;


            $update = $paper->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Paper has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Paper'
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

    public function set_status(Paper $paper)
    {
        return view('admin.papers.set_status', compact('paper'));
    }

    public function update_status(Request $request, Paper $paper)
    {
        $formFields = $request->validate([
            'status' => 'required'
        ]);


        try
        {
            $paper->status = $request->input('status');
            $paper->save();

            $data = [
                'error' => true,
                'status' => 'success',
                'message' => 'The Status has been successfully updated'
            ];
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'An error occurred updating the Status'
            ];
        }
        
        return redirect()->back()->with($data);
    }

    public function confirm_delete(Paper $paper)
    {
        return view('admin.papers.confirm_delete', compact('paper'));
    }

    public function destroy(Paper $paper)
    {
        // check if paper has been used
        $agenda_paper = Agenda::where('paper_id', $paper->id)->exists();

        if ($agenda_paper)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => "The Paper cannot be deleted because it's already in used in Meeting Agenda"
            ];

            return redirect()->back()->with($data);
        }

        $paper->delete();

        return redirect()->route('admin.papers.index');

    }
}
