<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Minute;

class Staff_MinuteController extends Controller
{
    //
     //
     public function index()
     {
         $minutes = Minute::orderBy('id', 'desc')->paginate(20);
 
         return view('staff.minutes.index', compact('minutes'));
     }
}
