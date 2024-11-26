<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Meeting;


class Admin_AttendanceController extends Controller
{
    //

    public function register(Meeting $meeting)
    {
        $staff = Staff::orderBy('surname', 'asc')->get();

        return view('admin.attendance.register', compact('staff', 'meeting'));
    }
}
