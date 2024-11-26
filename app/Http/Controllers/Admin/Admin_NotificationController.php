<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Meeting;
use App\Models\User;
use App\mail\UserNotificationMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class Admin_NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = Notification::orderBy('id','desc')->paginate(20);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        $meetings = Meeting::orderBy('title','asc')->get();
        return view('admin.notifications.create', compact('meetings'));
    }

    public function send(Request $request)
    {
        $formFields = $request->validate([
            'subject' => 'required',
            'meeting' => 'required',
            'message' => 'required'
        ]);


        $meeting = Meeting::find($request->meeting);

        $meeting_title = $meeting->title;
        $meeting_venue = $meeting->venue;
        $meeting_date = \Carbon\Carbon::parse($meeting->date)->format('l jS F, Y ');
        $meeting_time = \Carbon\Carbon::parse($meeting->time)->format('g:i a');
        
        
        
        $users = User::all();            

        foreach($users as $user)
        {   
            $fullname = $user->surname.' '.$user->firstname;
            $mailData = [
                'name' => $fullname,
                'subject' => $request->subject,
                'message' => $request->message,
                'meeting_title' => $meeting_title,
                'meeting_venue' => $meeting_venue,
                'meeting_date' => $meeting_date,
                'meeting_time' => $meeting_time,                
            ];            
            
            //sendUserMailJob::dispatch($user, $mailData)->onQueue('emails');
            Mail::to($user->email)->send(new UserNotificationMail($mailData));            
        }

        $formFields['meeting_id'] = $request->meeting;

        Notification::create($formFields);

        return redirect()->route('admin.notifications.send_completed');       

    }

    public function send_completed()
    {
        return view('admin.notifications.send_completed');
    }
}
