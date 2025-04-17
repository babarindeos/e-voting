<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\PaperComment;

class Staff_PaperController extends Controller
{
    //
    public function index()
    {
        $papers = Paper::orderBy('id', 'desc')->paginate(10);
       
        return view('staff.papers.index', compact('papers'));
    }

    public function show(Paper $paper)
    {
        $comments = PaperComment::where('paper_id', $paper->id)
                                    ->orderBy('id', 'desc')
                                    ->get();
        return view('staff.papers.show', compact('paper', 'comments'));
    }
}
