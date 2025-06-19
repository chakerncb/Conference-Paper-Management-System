<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\ConferenceSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $deadLines = [
            'submission' => ConferenceSetting::get('submission_deadline', 'Not Set'),
            'review' => ConferenceSetting::get('review_deadline', 'Not Set'),
            'camera_ready' => ConferenceSetting::get('camera_ready_deadline', 'Not Set'),
            'registration' => ConferenceSetting::get('registration_deadline', 'Not Set'),
        ];

        $submissionGuidelines = ConferenceSetting::get('submission_guidelines');
        $reviewCriteria = ConferenceSetting::get('review_criteria');

        return view('author.home' , compact('deadLines' , 'submissionGuidelines', 'reviewCriteria'));
    }
}
