<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    //
    public function index()
    {
        $pendingReviews = auth()->user()->reviews()
                         ->where('score', null) // Only pending reviews
                         ->get();

        return view('reviewer.pendingReviews' , compact('pendingReviews'));
    }

    public function history()
    {
        $completedReviews = auth()->user()->reviews()
                             ->whereNotNull('score') // Completed reviews
                             ->get();

        return view('reviewer.ReviewsHistory', compact('completedReviews'));
    }
}
