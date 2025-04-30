<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Http;

class VotingCenterController extends Controller
{
    //
    public function index()
    {
        return view('guests.voting_center.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'matric_no' => 'required|string',
            'password' => 'required|string'
        ]);


        

        if (Auth::attempt(['matric_no' => $request->matric_no, 'password' => $request->password, 'role' => 'student']))
        {
            $request->session()->regenerate();

            return redirect()->route('student.dashboard.index');
        }
        else
        {   
            return back()->withErrors(['matric_no' => 'Invalid login credentials'])->withInput();
        }

    }
}
