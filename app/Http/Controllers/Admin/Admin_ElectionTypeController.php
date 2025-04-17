<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ElectionType;

class Admin_ElectionTypeController extends Controller
{
    //
    public function index()
    {

        $election_types = ElectionType::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.election_types.index', compact('election_types'));
    }

    public function create()
    {
        return view('admin.election_types.create');
    }

    public function store(Request $request)
    {
         $formFields = $request->validate([
            'name' => 'required|string|unique:election_types,name',
            'coverage' => 'required'
         ]);


         try
         {
            $create = ElectionType::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Election Type has been succesfully created'
                ];

            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Election Type'
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

    public function edit(ElectionType $election_type)
    {
        return view('admin.election_types.edit', compact('election_type'));
    }

    public function update(Request $request, ElectionType $election_type)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'coverage' => 'required'
        ]);

        try
        {
            $update = $election_type->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Election Type has been succesfully updated'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Election Type'
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

    public function confirm_delete(ElectionType $election_type)
    {
        return view('admin.election_types.confirm_delete', compact('election_type'));
    }
}
