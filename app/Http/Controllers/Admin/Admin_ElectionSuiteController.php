<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ElectionSuite;
use App\Models\ElectoralCommittee;

use Illuminate\Support\Str;

class Admin_ElectionSuiteController extends Controller
{
    //
    public function index()
    {
        $election_suites = ElectionSuite::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.election_suites.index', compact('election_suites'));
    }

    public function create()
    {
        $electoral_committees = ElectoralCommittee::orderBy('created_at', 'desc')->get();
        
        return view('admin.election_suites.create', compact('electoral_committees'));
    }

    public function store(Request $request)
    {
        
         $formFields = $request->validate([
            'name' => 'required|string|unique:election_suites,name'
         ]);

         $formFields['electoral_committee_id'] = $request->electoral_committee;
         $formFields['description'] = $request->description;
         $formFields['uuid'] = Str::orderedUuid();



         try
         {
                $create = ElectionSuite::create($formFields);


                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Election Suite has been succesfully created'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred creating the Election Suite'
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


    public function edit(ElectionSuite $election_suite)
    {
        $electoral_committees = ElectoralCommittee::orderBy('created_at', 'desc')->get();
        return view('admin.election_suites.edit', compact('election_suite', 'electoral_committees'));
    }


    public function update(Request $request, ElectionSuite $election_suite)
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        $formFields['electoral_committee_id'] = $request->electoral_committee;

        //$formFields['uuid'] = Str::orderedUuid();
        $formFields['description'] = $request->description;

        try
        {
             $update = $election_suite->update($formFields);

             if ($update)
             {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Election Suite has been succesfully updated'
                    ];
             }
             else
             {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred updating the Election Suite'
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


    public function show(ElectionSuite $election_suite)
    {
        return view('admin.election_suites.show', compact('election_suite'));
    }


    public function registered_voters(ElectionSuite $election_suite)
    {
            return view('admin.election_suites.registered_voters', compact('election_suite'));

    }

    public function confirm_delete(ElectionSuite $election_suite)
    {
        return view('admin.election_suites.confirm_delete', compact('election_suite'));
    }
}
