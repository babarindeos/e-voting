<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\ElectoralCommittee;


class Admin_ElectoralCommitteeController extends Controller
{
    //
    public function index()
    {
        $electoral_committees = ElectoralCommittee::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.electoral_committees.index', compact('electoral_committees'));
    }

    public function create()
    {
        return view('admin.electoral_committees.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|unique:electoral_committees,name'
        ]);

        try
        {
            $uuid = Str::orderedUuid();

            $formFields['uuid'] = $uuid;

            $create = ElectoralCommittee::create($formFields);

            if ($create)
            {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Electoral Committee has been succesfully created'
                    ];                
            }
            else
            {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred creating the Electoral Committee'
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

    public function edit(ElectoralCommittee $electoral_committee)
    {
        return view('admin.electoral_committees.edit', compact('electoral_committee'));
    }


    public function update(Request $request, ElectoralCommittee $electoral_committee)
    {
            $formFields = $request->validate([
                'name' => 'required'
            ]);


            try
            {
                $update = $electoral_committee->update($formFields);

                if ($update)
                {
                        $data = [
                            'error' => true,
                            'status' => 'success',
                            'message' => 'The Electoral Committee has been succesfully updated'
                        ];       
                }
                else
                {
                        $data = [
                            'error' => true,
                            'status' => 'fail',
                            'message' => 'An error occurred updating the Electoral Committee'
                        ];       
                }
            }
            catch(\Exception $e)
            {
                        $data = [
                            'error' => true,
                            'status' => 'fail',
                            'message' => 'An error occurred updating the Electoral Committee'
                        ];      
            }

            return redirect()->back()->with($data);
    }


    public function confirm_delete(Request $request, ElectoralCommittee $electoral_committee)
    {
            return view('admin.electoral_committees.confirm_delete', compact('electoral_committee'));
    }


    public function show(ElectoralCommittee $electoral_committee)
    {
        return view('admin.electoral_committees.show', compact('electoral_committee'));
    }

    public function destroy(ElectoralCommittee $electoral_committee)
    {
        $electoral_committee->delete();

        return redirect()->route('admin.electoral_committees.index');

    }
}
