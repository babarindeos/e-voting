<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ElectoralCommittee;
use App\Models\ElectoralCommitteePosition;
use App\Models\College;
use App\Models\Department;
use App\Http\Classes\Document;

use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\ElectoralCommitteeMember;


class Admin_ElectoralCommitteeMemberController extends Controller
{
    //
    public function create(ElectoralCommittee $electoral_committee)
    {


        $positions = ElectoralCommitteePosition::get();
        $colleges = College::get();
        $departments = Department::get();
        

        return view('admin.electoral_committee_members.create', compact('electoral_committee', 'positions', 'colleges', 'departments'));
    }


    public function store(Request $request, ElectoralCommittee $electoral_committee)
    {      

        $formFields = $request->validate([
            'position' => 'required',
            'surname' => 'required',
            'firstname' => 'required',            
        ]);


        $formFields['position_id'] = $request->position;
        $formFields['uuid'] = Str::orderedUuid();
        $formFields['electoral_committee_id'] = $electoral_committee->id;
        $formFields['othernames'] = $request->input('othernames');
        $formFields['college_id'] = $request->input('college');
        $formFields['department_id'] = $request->input('department');
        $formFields['level'] = $request->input('level');
        $formFields['slogan'] = $request->input('slogan');
        $formFields['bio'] = $request->input('bio');

        

        $file = '';
        $fileSize = '';
        $fileType = '';

        try
        {
            if ($request->hasFile('photo'))
            {
                $fullname = strtolower($formFields['surname'].'_'.strtolower($formFields['firstname']));
                $currentDateTime = Carbon::now()->format('Ymd_His');
                $filename = $fullname.'_'.$currentDateTime;
                $filename = $filename.".";
    
                $file = $request->file('photo');
                $fileSize = Document::getDocumentSize($file);
                $fileType = Document::getDocumentType($file);
    
                $new_filename = $filename.$file->getClientOriginalExtension();
    
                $file->storeAs('photos', $new_filename);    

                $formFields['photo'] = 'photos/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
                
            }
          
            //dd($formFields);
          
            $created = ElectoralCommitteeMember::create($formFields);

            

            if ($created)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Member has been successfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Member'
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

        return redirect()->back()->with($data);

    }


    public function edit(ElectoralCommitteeMember $member)
    {
        $positions = ElectoralCommitteePosition::get();
        $colleges = College::get();
        $departments = Department::get();

        return view('admin.electoral_committee_members.edit', compact('member', 'positions', 'colleges', 'departments'));
    }


    public function update(Request $request, ElectoralCommitteeMember $member)
    {
        $formFields = $request->validate([
            'position' => 'required',
            'surname' => 'required',
            'firstname' => 'required',            
        ]);


        $formFields['position_id'] = $request->position;
        //$formFields['uuid'] = Str::orderedUuid();
        //$formFields['electoral_committee_id'] = $electoral_committee->id;
        $formFields['othernames'] = $request->input('othernames');
        $formFields['college_id'] = $request->input('college');
        $formFields['department_id'] = $request->input('department');
        $formFields['level'] = $request->input('level');
        $formFields['slogan'] = $request->input('slogan');
        $formFields['bio'] = $request->input('bio');

        

        $file = '';
        $fileSize = '';
        $fileType = '';

        try
        {
            if ($request->hasFile('photo'))
            {
                $fullname = strtolower($formFields['surname'].'_'.strtolower($formFields['firstname']));
                $currentDateTime = Carbon::now()->format('Ymd_His');
                $filename = $fullname.'_'.$currentDateTime;
                $filename = $filename.".";
    
                $file = $request->file('photo');
                $fileSize = Document::getDocumentSize($file);
                $fileType = Document::getDocumentType($file);
    
                $new_filename = $filename.$file->getClientOriginalExtension();
    
                $file->storeAs('photos', $new_filename);    

                $formFields['photo'] = 'photos/'.$new_filename;
                $formFields['filesize'] = $fileSize;
                $formFields['filetype'] = $fileType;
                
            }
          
            //dd($formFields);
          
            $update = $member->update($formFields);

            

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Member has been successfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Member'
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

        return redirect()->back()->with($data);
        
    }


    public function confirm_delete(ElectoralCommitteeMember $member)
    {
        return view('admin.electoral_committee_members.confirm_delete', compact('member'));

    }



}
