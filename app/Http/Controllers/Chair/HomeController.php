<?php

namespace App\Http\Controllers\Chair;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth.chair');
    }
    /**
     * Show the chair dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('chair.index');
    }
}
