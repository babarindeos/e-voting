<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\MeetingComment;
use Illuminate\Support\Facades\Auth;

class Admin_MeetingCommentController extends Controller
{
    //
    public function store(Request $request, Meeting $meeting)
    {
        
        $formFields = $request->validate([
            'message' => 'required'
        ]);

        try
        {
            $formFields['meeting_id'] = $meeting->id;
            $formFields['user_id'] = Auth::user()->id;

            MeetingComment::create($formFields);
        }
        catch(\Exception $e)
        {

        }

        return redirect()->back();
    }

    public function destroy(MeetingComment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
