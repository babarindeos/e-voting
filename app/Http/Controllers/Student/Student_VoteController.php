<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Election;
use App\Models\Candidate;
use App\Models\Position;

use Illuminate\Support\Facades\Session;

class Student_VoteController extends Controller
{
    //
    public function start_voting(Request $request)
    {
        $uuid = $request->election_uuid;

        //dd($uuid);

        $election = Election::where('uuid', $uuid)->first();

        $election_positions = Candidate::where('election_id', $election->id)
                                ->select('position_id')
                                ->distinct()
                                ->get();

        
        if ($election->count())
        {
            Session::put('current_election', $election);

            $position_nav = $election_positions->pluck('position_id')->toArray();

            $total_pages = count($position_nav);
            Session::put('total_pages', $total_pages);
            

            Session::put('current_page', 0);
            Session::put('position_nav', $position_nav);



            
            return redirect()->route('student.elections.vote');

        }
        else
        {

        }
        

        // get the positions of the elections

    }


    public function vote()
    {
        return $this->handleVote();
    }

    public function previous()
    {

    }

    public function next()
    {

    }

    public function finalize()
    {

    }

    public function handleVote()
    {
        $current_election = Session::get('current_election');

        $position_nav = Session::get('position_nav');

        $current_page = Session::get('current_page');

        $position_id = $position_nav[$current_page];
        $position = Position::where('id', $position_id)->first();

        $candidates = Candidate::where('election_id', $current_election->id)
                                 ->where('position_id', $position_id)
                                 ->get();
        
        return view('student.voting.vote');
        
        
    }
}
