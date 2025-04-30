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
use App\Models\ElectionSuite;
use App\Models\Election;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\ElectoralCommittee;

class Admin_DashboardController extends Controller
{
    //
    public function index(){

        $election_suite_count = ElectionSuite::count();
        $election_count = Election::count();
        $position_count = Position::count();
        $candidate_count = Candidate::count();
        $committee_count = ElectoralCommittee::count();

        $election_suites = ElectionSuite::orderBy('created_at', 'desc')->take(1)->get();

        $elections = Election::orderBy('created_at', 'desc')->take(1)->get();

        $positions = Position::orderBy('created_at', 'desc')->take(3)->get();

        $candidates = Candidate::orderBy('created_at', 'desc')->take(3)->get();

        $committees = ElectoralCommittee::orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.dashboard', compact('election_suites', 'elections', 'positions', 'candidates', 'committees'))->with([
            "election_suite_count" => $election_suite_count,
            "election_count" => $election_count,
            "position_count" => $position_count,
            "candidate_count" => $candidate_count,
            "committee_count" => $committee_count,
        ]);

    }
}
