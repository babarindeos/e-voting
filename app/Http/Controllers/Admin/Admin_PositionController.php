<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Models\Position;

class Admin_PositionController extends Controller
{
    //
    public function index()
    {
        $positions = Position::orderBy('created_at', 'asc')->paginate(20);
        return view('admin.positions.index', compact('positions'));
    }


    public function create()
    {
        return view('admin.positions.create');
    }


    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|unique:positions,name'
        ]);

        $uuid = Str::orderedUuid();

        $formFields['uuid'] = $uuid;

       try
       {
            $create = Position::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => "The Position has been successfully created"
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => "An error occurred creating the Position"
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


    public function edit(Position $position)
    {
            return view('admin.positions.edit', compact('position'));
    }


    public function update(Request $request, Position $position)
    {
            $formFields = $request->validate([
                'name' => 'required'
            ]);

            try
            {
                $update = $position->update($formFields);

                if ($update)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => "The Position has been successfully created"
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => "An error occured updating the Position"
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


    public function confirm_delete(Position $position)
    {
        return view('admin.positions.confirm_delete', compact('position'));
    }

    public function destroy(Position $position)
    {

    }
}
