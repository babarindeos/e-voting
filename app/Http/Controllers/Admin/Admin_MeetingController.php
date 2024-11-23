<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin_MeetingController extends Controller
{
    //
    public function index()
    {
        return view('admin.meetings.index');
    }
}
