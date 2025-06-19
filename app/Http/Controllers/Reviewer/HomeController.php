<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\ConferenceSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $pendingReviews = auth()->user()->reviews()
            ->whereNull('score')
            ->count();

        $completedReviews = auth()->user()->reviews()
            ->whereNotNull('score')
            ->count();

        $deadlines = [
            'submission' => ConferenceSetting::get('submission_deadline'),
            'review' => ConferenceSetting::get('review_deadline'),
            'camera_ready' => ConferenceSetting::get('camera_ready_deadline'),
            'registration' => ConferenceSetting::get('registration_deadline'),
        ];

        return view('reviewer.home' , compact('pendingReviews', 'completedReviews', 'deadlines'));
    }

}
