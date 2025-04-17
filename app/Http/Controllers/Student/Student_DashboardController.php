<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Election;

class Student_DashboardController extends Controller
{
    //
    public function index()
    {

        $live_elections = Election::where('live_status', true)->orderBy('created_at', 'asc')->get();
        return view('student.dashboard', compact('live_elections'));
    }
}
