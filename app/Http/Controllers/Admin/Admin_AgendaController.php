<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Paper;
use App\Models\Agenda;


class Admin_AgendaController extends Controller
{
    //
    public function index(Meeting $meeting)
    {
        $papers = Paper::orderBy('title','asc')->get();
        $agenda = Agenda::where('meeting_id', $meeting->id)->get();

        return view('admin.agenda.index', compact('meeting','papers','agenda'));
    }

    public function store(Request $request, Meeting $meeting)
    {
        $formFields = $request->validate([
            'title' => 'required'
        ]);

        $is_added = Agenda::where('title', $request->title)
                            ->where('paper_id', $request->paper)
                            ->exists();
        if ($is_added)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'The Agendum has already been added to the Meeting'
            ];

            return redirect()->back()->with($data);
        }

        $formFields['meeting_id'] = $meeting->id;
        $formFields['paper_id'] = $request->paper;

        try
        {
            $create = Agenda::create($formFields);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Agendum has been successfully added to the Meeting'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'The Agendum has already been added to the Meeting'
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

    public function delete(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->back();
    }
}
