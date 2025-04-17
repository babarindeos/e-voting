<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ElectionSuite;

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
        return view('admin.election_suites.create');
    }

    public function store(Request $request)
    {
         $formFields = $request->validate([
            'name' => 'required|string|unique:election_suites,name'
         ]);

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
        return view('admin.election_suites.edit', compact('election_suite'));
    }


    public function update(Request $request, ElectionSuite $election_suite)
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        $formFields['uuid'] = Str::orderedUuid();
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


    public function confirm_delete(ElectionSuite $election_suite)
    {
        return view('admin.election_suites.confirm_delete', compact('election_suite'));
    }
}
