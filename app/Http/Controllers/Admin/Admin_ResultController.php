<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Election;
use App\Models\Vote;
use App\Models\VoterRegistration;
use App\Models\Candidate;


class Admin_ResultController extends Controller
{
    //
    public function index()
    {
        $elections = Election::orderBy('created_at', 'desc')->get();

        return view('admin.results.elections', compact('elections'));
    }


    public function show(Election $election)
    {
        return view('admin.results.show', compact('election'));
    }


    public function voter_votes(Election $election, VoterRegistration $voter)
    {
        //dd($voter);
        $votes = Vote::where('election_id', $election->id)
                     ->where('voter_id', $voter->id )
                     ->get();
        //dd($votes);
        
        

        return view('admin.results.voter_votes', compact('election', 'voter', 'votes'));
    }

    public function candidate_votes(Election $election, Candidate $candidate)
    {
        //dd($candidate);
         //dd($voter);
         $votes = Vote::where('election_id', $election->id)
                        ->where('candidate_id', $candidate->id )
                        ->get();

         return view('admin.results.candidate_votes', compact('election', 'candidate', 'votes'));

    }
}
