<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ElectionRegistration;

use App\Models\ElectionSuite;


class Admin_ElectionRegistrationController extends Controller
{
    //
    public function index()
    {

        $election_registrations = ElectionRegistration::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.election_registrations.index', compact('election_registrations'));

    }


    public function create()
    {
        $election_suites = ElectionSuite::orderBy('name', 'asc')->get();

        return view('admin.election_registrations.create', compact('election_suites'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'election_suite' => 'required|unique:election_registrations,election_suite_id',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required'            
        ]);

        $uuid = Str::orderedUuid();
        $formFields['uuid'] = $uuid;

        $formFields['election_suite_id'] = $request->election_suite;

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
            $create = ElectionRegistration::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Election Registration has been created successfully"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred creating the Election Registration"
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


    public function edit(Request $request, ElectionRegistration $election_registration)
    {
        $election_suites = ElectionSuite::orderBy('name', 'asc')->get();
        return view('admin.election_registrations.edit', compact('election_registration', 'election_suites'));
    }


    public function update(Request $request, ElectionRegistration $election_registration)
    {
       
        $formFields = $request->validate([
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required' 
        ]);
      

        //$formFields['election_suite_id'] = $request->election_suite;
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
            $update = $election_registration->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Election Registration has been updated successfully"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred updating the Election Registration"
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


    public function confirm_delete(ElectionRegistration $election_registration)
    {
        return view('admin.election_registrations.confirm_delete', compact('election_registration'));
    }


    public function destroy()
    {
        
    }



}
