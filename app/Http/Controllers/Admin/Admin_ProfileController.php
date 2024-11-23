<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;

class Admin_ProfileController extends Controller
{
    public function user_profile($fileno)
    {
        $userprofile = Staff::where('fileno', $fileno)->first();
        
        return view('admin.profile.user_profile', compact('userprofile'));
    }

    public function email_user_profile($email)
    {
        $userprofile = User::where('email', $email)->first();

        return view('admin.profile.email_user_profile', compact('userprofile'));
    }

}
