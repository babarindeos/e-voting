<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Staff;
use App\Models\User;
use App\Models\Workflow;
use App\Models\Department;
use App\Models\Digest;
use App\Models\Paper;
use App\Models\Meeting;
use Illuminate\Support\Facades\DB;
use App\Models\Announcement;
use App\Models\Minute;

class Admin_DashboardController extends Controller
{
    //
    public function index(){

        $meeting_count = Meeting::count();
        $staff_count = Staff::count();
        $digest_count = Digest::count();
        $paper_count = Paper::count();
        $department_count = Department::count();

        $announcements = Announcement::orderBy('created_at', 'desc')->take(1)->get();

        $meetings = Meeting::orderBy('created_at', 'desc')->take(1)->get();

        $papers = Paper::orderBy('created_at', 'desc')->take(3)->get();

        $minutes = Minute::orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.dashboard', compact('announcements', 'meetings', 'papers', 'minutes'))->with([
            "meeting_count" => $meeting_count,
            "digest_count" => $digest_count,
            "staff_count" => $staff_count,
            "paper_count" => $paper_count,
            "department_count" => $department_count,
        ]);

    }
}
