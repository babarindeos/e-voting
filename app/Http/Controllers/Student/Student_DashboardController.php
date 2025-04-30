<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Election;

use Carbon\Carbon;

class Student_DashboardController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now('Africa/Lagos');

        $live_elections = Election::where('live_status', true)
                                    ->whereDate('start_date', '<=', $now)
                                    ->whereDate('end_date', '>=', $now)
                                    ->whereTime('start_time', '<=', $now)
                                    ->whereTime('end_time', '>=', $now)
                                    ->orderBy('created_at', 'asc')->get();

        /* foreach($live_elections as $election)
        {
            dd($election->finalized_votes);
        } */
                
        return view('student.dashboard', compact('live_elections'));

    }


}
