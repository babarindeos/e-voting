<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use Carbon\Carbon;
use App\Http\Classes\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\MeetingComment;
use App\Models\Agenda;

class Staff_MeetingController extends Controller
{
    //
    //
    public function index()
    {
        $meetings = Meeting::orderBy('id', 'desc')->paginate(20);

        return view('staff.meetings.index', compact('meetings'));
    }

    public function show(Meeting $meeting)
    {

        $agenda = Agenda::where('meeting_id', $meeting->id)->get();

        $comments = MeetingComment::where('meeting_id', $meeting->id)
                                    ->orderBy('id', 'desc')
                                    ->get();

        return view('staff.meetings.show', compact('meeting', 'comments', 'agenda'));
    }
}
