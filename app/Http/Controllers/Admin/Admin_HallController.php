<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Hall;
use App\Models\ElectionSuite;

class Admin_HallController extends Controller
{
    //
    public function index()
    {
        $halls = Hall::orderBy('created_at', 'desc')->paginate(50);

        return view('admin.halls.index', compact('halls'));
    }

    public function create()
    {
        $election_suites = ElectionSuite::orderBy('name', 'asc')->get();
        return view('admin.halls.create', compact('election_suites'));
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'election_suite' => 'required',
            'name' => 'required|unique:halls,name'
        ]);

        $uuid = Str::orderedUuid();

        $formFields['election_suite_id'] = $request->election_suite;
        $formFields['uuid'] = $uuid;
        
        try
        {
                $create = Hall::create($formFields);


                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Hall of Residence has been succesfully created'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred creating the Hall of Residence'
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


    public function edit(Hall $hall)
    {
        return view('admin.halls.edit', compact('hall'));
    }


    public function update(Request $request, Hall $hall)
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        try
        {
            $update = $hall->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Hall of Residence has been succesfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Hall of Residence'
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


    public function show(Hall $hall)
    {
            return view('admin.halls.show', compact('hall'));
    }

    public function confirm_delete(Hall $hall)
    {
        return view('admin.halls.confirm_delete', compact('hall'));        
    }


    public function destroy(Hall $hall)
    {
        $hall->delete();

        return redirect()->route('admin.halls.index');


    }

}
