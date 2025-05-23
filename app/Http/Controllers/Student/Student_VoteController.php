<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Election;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\Vote;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\VoterRegistration;
use App\Models\FinalizedVote;

use Illuminate\Support\Str;

class Student_VoteController extends Controller
{
    //
    public function start_voting(Request $request)
    {
        $uuid = $request->election_uuid;

        //dd($uuid);

        $election = Election::where('uuid', $uuid)->first();


        // get the positions of the elections
        $election_positions = Candidate::where('election_id', $election->id)
                                ->select('position_id')
                                ->distinct()
                                ->get();
        
        
        if (count($election_positions) == 0)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'There are currently no Candidates for the Election. Contact the Administrator.'
            ];

            return redirect()->back()->with($data);

        }

        
          // get the current registered voter id for the election suite
        // get current voter 
        $current_voter = VoterRegistration::where('election_suite_id', $election->election_suite_id)
                                     ->where('user_id', Auth::user()->id)
                                     ->first();
       
        Session::put('current_voter', $current_voter);



        
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
        

      
        

    }


    public function vote()
    {
        return $this->handleVote();
    }

    public function previous()
    {
        if (!Session::has('current_election'))
        {
            return redirect()->route('student.dashboard.index');
        }

        $current_page = Session::get('current_page');

        if ($current_page != 0)
        {
            Session::put('current_page', $current_page - 1);
        }
       

        return redirect()->route('student.elections.vote');
    }

    public function next()
    {

        if (!Session::has('current_election'))
        {
            return redirect()->route('student.dashboard.index');
        }

        $current_page = Session::get('current_page');


        $total_pages = Session::get('total_pages');
        
        $total_pages_zero_index = $total_pages - 1;

        
        
        if ($current_page < $total_pages_zero_index)
        {
            $current_page++;
            Session::put('current_page', $current_page);
        }
       
       
      
             

        return redirect()->route('student.elections.vote');
    }

    public function finalize()
    {

       
    }

    public function handleVote()
    {
        if (!Session::has('current_election'))
        {
            return redirect()->route('student.dashboard.index');
        }

        $current_election = Session::get('current_election');

        $position_nav = Session::get('position_nav');

        $current_page = Session::get('current_page');
        $total_pages = Session::get('total_pages');

        $position_id = $position_nav[$current_page];
        
        $position = Position::where('id', $position_id)->first();

        $candidates = Candidate::where('election_id', $current_election->id)
                                 ->where('position_id', $position_id)
                                 ->get();

       
        // get current voter 
        $current_voter = Session::get('current_voter');

       
        
        
        // get casted vote for the election, position by the voter
        $cast_vote = Vote::where('election_id', $current_election->id)
                         ->where('position_id', $position_id)
                         ->where('voter_id', $current_voter->id)
                         ->first();

                         
        
        return view('student.voting.vote', compact('position', 'current_page', 'total_pages', 'candidates'))
                    ->with(['election' => $current_election, 'cast_vote' => $cast_vote ]);
        
        
    }


    public function cast_vote(Request $request)
    {
        if (!Session::has('current_election'))
        {
            return redirect()->route('student.dashboard.index');
        }
        

        $request->validate([
            'candidate' => 'required'
        ]);


        $noOption = false;
        $yesOption = false;
        $voidOption = false;


        if ($request->has('single_candidate'))
        {
            if ($request->candidate == 'No')
            {
                $noOption = true;
                $candidate_id = $request->single_candidate;
            }
            elseif ($request->candidate == 'Yes')
            {
                $yesOption = true;
                $candidate_id = $request->single_candidate;
            }
            elseif ($request->candidate == 'void')
            {
                $voidOption = true;
                $candidate_id = null;
            }            
            
        }
        else
        {
           if ($request->candidate != 'void')
           {
               $yesOption = true;
               $candidate_id = $request->candidate;
           }
           else
           {
                $candidate_id = null;
                $voidOption = true;
           }
        }


        // get the current election

        $current_election = Session::get('current_election');
        $current_election_id = $current_election->id;
        

        // get the current position
        $position_nav = Session::get('position_nav');
        $current_page = Session::get('current_page');
        $position_id = $position_nav[$current_page];

         

        // get the current registered voter
        $current_voter = Session::get('current_voter');
        


        // determine if vote has already been cast for the election, position by the voter
        $vote_cast = Vote::where('election_id', $current_election->id)
                         ->where('position_id', $position_id)
                         ->where('voter_id', $current_voter->id)
                         ->first();
        
        
        if ($vote_cast == null)
        {
            $formFields = [
                'uuid' => Str::orderedUuid(),
                'election_id' => $current_election_id,
                'position_id' =>  $position_id,
                'voter_id' => $current_voter->id,
                'candidate_id' => $candidate_id,
                'yes' => $yesOption,
                'no' => $noOption,
                'void' => $voidOption
            ];

            

            Vote::create($formFields);
        }
        else
        {
            $formFields = [                
                'candidate_id' => $candidate_id,
                'yes' => $yesOption,
                'no' => $noOption,
                'void' => $voidOption
            ];

           

            $vote_cast->update($formFields);
        }

        return $this->handleVote();
    }

    public function preview()
    {
        if (!Session::has('current_election'))
        {
            return redirect()->route('student.dashboard.index');
        }
        
        // get the current election

        $current_election = Session::get('current_election');
        $current_election_id = $current_election->id;
        

        // get the current position
        $position_nav = Session::get('position_nav');
        $current_page = Session::get('current_page');
        $position_id = $position_nav[$current_page];
        $position = Position::where('id', $position_id)->first();

         

        // get the current registered voter
        $current_voter = Session::get('current_voter');

        // total pages
        $total_pages = Session::get('total_pages');

        


        // determine if vote has already been cast for the election, position by the voter
        $votes_cast = Vote::where('election_id', $current_election->id)
                         ->where('voter_id', $current_voter->id)
                         ->get();

    
        return view('student.voting.preview', compact('current_page', 'total_pages','votes_cast', 'position'))->with(['election' => $current_election]);
        
    }


    public function finalize_voting(Request $request)
    {
        if (!Session::has('current_election'))
        {
            
            return redirect()->route('guest.voting_center.index');
        }

        $uuid = Str::orderedUuid();

        $current_election = Session::get('current_election');
        $current_voter = Session::get('current_voter');
        

        // check if finalized voting has been recorded for this user
        $finalized_voting = FinalizedVote::where('election_id', $current_election->id)
                                          ->where('voter_id', $current_voter->id)
                                          ->first();
        
        if ($finalized_voting == null)
        {
                    $formFields = [
                        'uuid' => $uuid,
                        'election_id' => $current_election->id,
                        'voter_id' => $current_voter->id
                    ];
            
                    FinalizedVote::create($formFields);
        }     


        Session::forget('current_election');
        Session::forget('total_pages');
        Session::forget('current_page');
        Session::forget('position_nav');
        Session::forget('current_voter');
        Session::flush();

        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('student.elections.vote.voting_completed', ['election' => $current_election->uuid])->withHeaders([
                            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                        ]);
    }

    public function voting_completed(Request $request, $election)
    {
        

         
         

         return view('guests.voting_center.voting_completed');
    }




    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
