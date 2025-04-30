<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\ElectoralCommitteePosition;

class Admin_ElectoralCommitteePositionController extends Controller
{
    //
    public function index()
    {
        $positions = ElectoralCommitteePosition::orderBy('created_at', 'asc')->paginate(100);

        return view('admin.electoral_committee_positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.electoral_committee_positions.create');
    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'position' => 'required|string|unique:electoral_committee_positions,position'
        ]);

        try
        {
            $uuid = Str::orderedUuid();

            $formFields['uuid'] = $uuid;


            $create = ElectoralCommitteePosition::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Electoral Committee Position has been succesfully created'
                ];       
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Electoral Committee Position'
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


    public function edit(ElectoralCommitteePosition $position)
    {
        return view('admin.electoral_committee_positions.edit', compact('position'));
    }


    public function update(Request $request, ElectoralCommitteePosition $position)
    {
        
        $formFields = $request->validate([
            'position' => 'required|string|unique:electoral_committee_positions,position'
        ]);

        try
        {
            $update = $position->update($formFields);

            if ($update)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Electoral Committee Position has been succesfully updated'
                ];       
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating the Electoral Committee Position'
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


    public function confirm_delete(ElectoralCommitteePosition $position)
    {
        return view('admin.electoral_committee_positions.confirm_delete', compact('position'));
    }


    public function destroy(Request $request, ElectoralCommitteePosition $position)
    {
        if ($position->members->count())
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The Electoral Committe Position cannot be deleted as it has members'
            ];

            return redirect()->back()->with($data);
        }

        $position->delete();

        return redirect()->route('admin.electoral_committees.positions.index');
    }

}
