<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Position;
use App\Models\Election;
use App\Models\College;
use App\Models\Department;
use App\Models\Candidate;

class Admin_CandidateController extends Controller
{
    //

    public function index()
    {

    }


    public function create(Election $election)
    {
        $positions = Position::orderBy('created_at', 'asc')->get();
        $colleges = College::orderBy('name', 'asc')->get();
        $departments = Department::orderBy('name', 'asc')->get();

        return view('admin.elections.create_candidate', compact('positions', 'election', 'colleges', 'departments'));


    }


    public function store(Request $request, Election $election)
    {
        $formFields = $request->validate([
            'position' => 'required|string',
            'matric_no' => 'required',
            'surname' => 'required',
            'firstname' => 'required',
            'alias' => 'required',

        ]);

        $formFields['uuid'] = Str::orderedUuid();
        $formFields['election_id'] = $election->id;
        $formFields['position_id'] = $request->input('position');
        $formFields['othernames'] = $request->input('othernames');
        $formFields['college_id'] = $request->input('college');
        $formFields['department_id'] = $request->input('department');
        $formFields['level'] = $request->input('level');
        $formFields['slogan'] = $request->input('slogan');
        $formFields['bio'] = $request->input('bio');

        $photo = '';
        $banner = '';
        $manifesto = '';

        try
        {
            $filename = strtolower($request->surname)."_".$request->matric_no.".";

            if ($request->hasFile('photo'))
            {
                $photoFile = $request->file('photo');
    
                $new_photoFilename = $filename.$photoFile->getClientOriginalExtension();
    
                $photoFile->storeAs('candidate_photos', $new_photoFilename);
    
                $formFields['photo'] = 'candidate_photos/'.$new_photoFilename;
    
            }
    
    
            if ($request->hasFile('banner'))
            {
                $bannerFile = $request->file('banner');
    
                $new_bannerFilename = $filename.$bannerFile->getClientOriginalExtension();
    
                $bannerFile->storeAs('candidate_banners', $new_bannerFilename);
    
                $formFields['banner'] = 'candidate_banners/'.$new_bannerFilename;
    
            }
    
    
            if ($request->hasFile('manifesto'))
            {
                $manifestoFile = $request->file('manifesto');
    
                $new_manifestoFilename = $filename.$manifestoFile->getClientOriginalExtension();
    
                $manifestoFile->storeAs('candidate_manifestoes', $new_manifestoFilename);

                $formFields['manifesto'] = 'candidate_manifestoes/'.$new_manifestoFilename;
            }
    

            $create = Candidate::create($formFields);

            if ($create)
            {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Candidate has been succesfully created'
                    ];
            }
            else
            {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred creating the Candidate'
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


    public function show(Candidate $candidate)
    {
        return view('admin.candidates.show', compact('candidate'));
    }


    public function edit(Candidate $candidate)
    {
        $positions = Position::orderBy('created_at', 'asc')->get();
        $colleges = College::orderBy('name', 'asc')->get();
        $departments = Department::orderBy('name', 'asc')->get();

        return view('admin.candidates.edit', compact('candidate', 'positions', 'colleges', 'departments'));
    }


    public function update(Request $request, Candidate $candidate)
    {
        $formFields = $request->validate([
            'position' => 'required|string',
            'matric_no' => 'required',
            'surname' => 'required',
            'firstname' => 'required',
            'alias' => 'required',

        ]);

        
        
        $formFields['position_id'] = $request->input('position');
        $formFields['othernames'] = $request->input('othernames');
        $formFields['college_id'] = $request->input('college');
        $formFields['department_id'] = $request->input('department');
        $formFields['level'] = $request->input('level');
        $formFields['slogan'] = $request->input('slogan');
        $formFields['bio'] = $request->input('bio');

        $photo = '';
        $banner = '';
        $manifesto = '';

        try
        {
            $filename = strtolower($request->surname)."_".$request->matric_no.".";

            if ($request->hasFile('photo'))
            {
                $photoFile = $request->file('photo');
    
                $new_photoFilename = $filename.$photoFile->getClientOriginalExtension();
    
                $photoFile->storeAs('candidate_photos', $new_photoFilename);
    
                $formFields['photo'] = 'candidate_photos/'.$new_photoFilename;
    
            }
    
    
            if ($request->hasFile('banner'))
            {
                $bannerFile = $request->file('banner');
    
                $new_bannerFilename = $filename.$bannerFile->getClientOriginalExtension();
    
                $bannerFile->storeAs('candidate_banners', $new_bannerFilename);
    
                $formFields['banner'] = 'candidate_banners/'.$new_bannerFilename;
    
            }
    
    
            if ($request->hasFile('manifesto'))
            {
                $manifestoFile = $request->file('manifesto');
    
                $new_manifestoFilename = $filename.$manifestoFile->getClientOriginalExtension();
    
                $manifestoFile->storeAs('candidate_manifestoes', $new_manifestoFilename);

                $formFields['manifesto'] = 'candidate_manifestoes/'.$new_manifestoFilename;
            }
    

            $update = $candidate->update($formFields);

            if ($update)
            {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Candidate has been succesfully updated'
                    ];
            }
            else
            {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred updating the Candidate'
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


    public function confirm_delete(Candidate $candidate)
    {
        return view('admin.candidates.confirm_delete', compact('candidate'));
    }

    public function destroy(Candidate $candidate)
    {

    }

}
