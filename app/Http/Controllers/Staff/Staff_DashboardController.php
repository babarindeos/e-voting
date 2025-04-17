<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workflow;
use App\Models\PrivateMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Digest;
use App\Models\Paper;
use App\Models\Meeting;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Models\Minute;
use App\Models\Staff;
use App\Models\Department;

class Staff_DashboardController extends Controller
{

    public function __construct()
    {
        // check if the user profile has been filled
       
    }

    //
    public function index()
    {
        
        $profileExists = Profile::where('user_id', Auth::user()->id)->exists();

        // if user profile does not exist, create it
        if (!$profileExists)
        {
            return redirect()->route('staff.profile.create');
        }

        // get notification


        $meeting_count = Meeting::count();
        $staff_count = Staff::count();
        $digest_count = Digest::count();
        $paper_count = Paper::count();
        $department_count = Department::count();
        $minute_count = Minute::count();

        $announcements = Announcement::orderBy('created_at', 'desc')->take(1)->get();

        $meetings = Meeting::orderBy('created_at', 'desc')->take(1)->get();

        $papers = Paper::orderBy('created_at', 'desc')->take(3)->get();

        $minutes = Minute::orderBy('created_at', 'desc')->take(3)->get();

        return view('staff.dashboard', compact('announcements', 'meetings', 'papers', 'minutes'))->with([
            "meeting_count" => $meeting_count,
            "digest_count" => $digest_count,
            "staff_count" => $staff_count,
            "paper_count" => $paper_count,
            "department_count" => $department_count,
            'minute_count' => $minute_count
        ]);
        
       


    }
}
