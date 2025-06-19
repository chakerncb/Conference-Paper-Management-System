<?php

namespace App\Http\Controllers\Chair;

use App\Http\Controllers\Controller;
use App\Models\ConferenceSetting;
use App\Models\Paper;
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
        $totalPapers = Paper::count();
        $acceptedPapers = Paper::where('status', 'Accepted')->count();
        $underReviewPapers = Paper::where('status', 'Under Review')->count();
        $rejectedPapers = Paper::where('status', 'Rejected')->count(); 

        $currentYear = date('Y');
        $monthlyPapers = [];
        $monthLabels = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $monthLabels[] = $monthName;
              $count = Paper::whereYear('created_at', $currentYear)
                          ->whereMonth('created_at', $month)
                          ->count();
            
            $monthlyPapers[] = $count;
        }

        $deadLines = [
            'submission' => ConferenceSetting::get('submission_deadline', 'Not Set'),
            'review' => ConferenceSetting::get('review_deadline', 'Not Set'),
            'camera_ready' => ConferenceSetting::get('camera_ready_deadline', 'Not Set'),
            'registration' => ConferenceSetting::get('registration_deadline', 'Not Set'),
        ];

        return view('chair.index', compact(
            'totalPapers', 
            'acceptedPapers', 
            'underReviewPapers', 
            'rejectedPapers', 
            'deadLines',
            'monthlyPapers',
            'monthLabels'
        ));
    }
}
