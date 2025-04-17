<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaperComment;
use Illuminate\Support\Facades\Auth;
use App\Models\Paper;

class Staff_PaperCommentController extends Controller
{
    //
    public function store(Request $request, Paper $paper)
    {
        
        $formFields = $request->validate([
            'message' => 'required'
        ]);

        try
        {
            $formFields['paper_id'] = $paper->id;
            $formFields['user_id'] = Auth::user()->id;

            PaperComment::create($formFields);
        }
        catch(\Exception $e)
        {

        }

        return redirect()->back();
    }


    public function destroy(PaperComment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
