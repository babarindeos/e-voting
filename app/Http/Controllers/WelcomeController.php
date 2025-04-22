<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Election;

use App\Models\ElectionRegistration;
use App\Models\Candidate;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now('Africa/Lagos');

        //dd($now->toDateString());
        //dd($now->toTimeString());

        $registrations = ElectionRegistration::where('live_status', 1)
                                            ->whereDate('start_date', '<=', $now)
                                            ->whereDate('end_date', '>=', $now)
                                            ->whereTime('start_time', '<=', $now)
                                            ->whereTime('end_time', '>=', $now)
                                            ->get();
        

        $elections = Election::where('live_status', 1)
                            ->whereDate('start_date', '<=', $now)
                            ->whereDate('end_date', '>=', $now)
                            ->whereTime('start_time', '<=', $now)
                            ->whereTime('end_time', '>=', $now)
                            ->get();
        
        
        
        return view('welcome', compact('registrations', 'elections'));
    }


    public function candidate_alias($candidate_alias)
    {
         $candidate = Candidate::where('alias', $candidate_alias)->first();

         return view('guests.candidate', compact('candidate'));
    }
}
