<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $matric_no = $request->matric_no;
        $email = $matric_no.'@funiec.com';
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 'student']))
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
