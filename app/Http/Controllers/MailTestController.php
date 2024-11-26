<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SimpleMail;
use App\Mail\ParamsMail;
use App\Jobs\SendUserMailJob;
use App\Models\User;
use App\mail\UserNotificationMail;


class MailTestController extends Controller
{
    //
   

    public function dispatch()
    {
        Mail::to("kondishiva007@gmail.com")->send(new SimpleMail());

        return "Sent mail";
    }

    public function param_dispatch()
    {
        $name = "Babarinde Oluwaseyi";
        $email = "kondishiva008@gmail.com";

        Mail::to($email)->send(new ParamsMail($name));

        return response()->json(['message' => 'message sent']);

    }

    public function QueueMailer()
    {
        $users = User::all();
        $status = '';

        foreach($users as $user)
        {
            $mailData = [
                'name' => $user->surname,
                'message' => 'Senate meeting...',
            ];

            
            //sendUserMailJob::dispatch($user, $mailData)->onQueue('emails');
            Mail::to($user->email)->send(new UserNotificationMail($mailData));

    
        }

        
        
        //return response()->json(['message' => 'Emails are being sent']);
    }
}
