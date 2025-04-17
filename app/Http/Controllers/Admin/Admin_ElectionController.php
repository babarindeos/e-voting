<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Election;
use App\Models\College;
use App\Models\ElectionSuite;

use App\Models\ElectionType;

use Illuminate\Support\Str;


class Admin_ElectionController extends Controller
{
    //
    public function index()
    {
        $elections = Election::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.elections.index', compact('elections'));
    }


    public function create()
    {
        $election_suites = ElectionSuite::orderBy('created_at', 'desc')->get();
        $colleges  = College::get();
        $election_types = ElectionType::get();

        return view('admin.elections.create', compact('election_suites', 'colleges', 'election_types'));
    }


    public function store(Request $request)
    {

        //dd($request); 
        //dd($request->has('live_status')); 

        $formFields = $request->validate([
            'election_suite' => 'required',
            'election_type' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required'
        ]);

        if ($request->election_type == 2)
        {
            return back()->withErrors(['college' => 'The College for the Election is required'])->withInput();
        }

        $formFields['college_id'] = $request->college;
        $formFields['election_suite_id'] = $request->input('election_suite');
        $formFields['election_type_id'] = $request->input('election_type');
        $formFields['uuid'] = Str::orderedUuid();

        if ($request->has('live_status'))
        {
            $formFields['live_status'] = true;
        }

        try
        {
            $create = Election::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Election has been succesfully created'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Election'
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


    public function show(Election $election)
    {
        
        return view('admin.elections.show', compact('election'));

    }


    public function edit(Election $election)
    {
        $election_suites = ElectionSuite::orderBy('created_at', 'desc')->get();
        $colleges  = College::get();
        $election_types = ElectionType::get();

        return view('admin.elections.edit', compact('election', 'election_suites', 'colleges', 'election_types'));
    }



    public function update(Request $request, Election $election)
    {
        $formFields = $request->validate([
            'election_suite' => 'required',
            'election_type' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required'
        ]);

        if ($request->election_type == 2)
        {
            return back()->withErrors(['college' => 'The College for the Election is required'])->withInput();
        }

        $formFields['college_id'] = $request->college;
        $formFields['election_suite_id'] = $request->input('election_suite');
        $formFields['election_type_id'] = $request->input('election_type');
        //$formFields['uuid'] = Str::orderedUuid();

        if ($request->has('live_status'))
        {
            $formFields['live_status'] = true;
        }
        else
        {
            $formFields['live_status'] = false;
        }

        try
        {
            $update = $election->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Election has been succesfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Election'
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


    public function confirm_delete(Election $election)
    {
        return view('admin.elections.confirm_delete', compact('election'));
    }


    public function destroy(Election $election)
    {

    }


}
