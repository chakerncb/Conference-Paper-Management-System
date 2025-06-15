<?php

namespace App\Http\Controllers\Chair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PapersController extends Controller
{
    //
    public function index()
    {
        return view('chair.papers');
    }
}
