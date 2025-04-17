<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Digest;

class Staff_DigestController extends Controller
{
    //
    public function index()
    {
        $digests = Digest::orderBy('id', 'desc')->paginate(20);
        return view('staff.digests.index', compact('digests'));
    }
}
