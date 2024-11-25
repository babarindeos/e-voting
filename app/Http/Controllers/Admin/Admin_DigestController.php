<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Digest;
use Carbon\Carbon;
use illuminate\Support\Facades\Auth;
use App\Http\Classes\Document;

class Admin_DigestController extends Controller
{
    //
    public function index()
    {
        $digests = Digest::orderBy('id', 'desc')->paginate(20);
        return view('admin.digests.index', compact('digests'));
    }

    public function create()
    {
        return view('admin.digests.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png'
        ]);

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
    
                $file->storeAs('digests', $new_filename);    

                $formFields['file'] = 'digests/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
            }

            
            $formFields['user_id'] = Auth::user()->id;


            $created = Digest::create($formFields);

            if ($created)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Digest has been successfully uploaded'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred uploading the Digest'
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
}
