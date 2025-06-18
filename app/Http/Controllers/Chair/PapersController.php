<?php

namespace App\Http\Controllers\Chair;

use App\Http\Controllers\Controller;
use App\Models\Paper;
use Illuminate\Http\Request;

class PapersController extends Controller
{
    //
    public function index()
    {
        $paerpsCount = Paper::count();

        return view('chair.papers' , compact('paerpsCount'));
    }
}
