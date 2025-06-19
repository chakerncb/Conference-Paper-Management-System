<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConferenceSetting;
use App\Models\User;
use App\Models\Roles;

class HomeController extends Controller
{
    public function index()
    {
        // Get all general settings
        $settings = [
            'conference_name' => ConferenceSetting::get('conference_name', 'International Conference'),
            'conference_acronym' => ConferenceSetting::get('conference_acronym', 'CONF'),
            'conference_year' => ConferenceSetting::get('conference_year', date('Y')),
            'conference_location' => ConferenceSetting::get('conference_location', 'University Campus'),
            'conference_website' => ConferenceSetting::get('conference_website', 'https://conference.example.com'),
            'conference_description' => ConferenceSetting::get('conference_description', 'A premier international conference bringing together researchers and practitioners.'),
            
            // Deadlines
            'submission_deadline' => ConferenceSetting::get('submission_deadline', '2025-08-15'),
            'review_deadline' => ConferenceSetting::get('review_deadline', '2025-09-30'),
            'camera_ready_deadline' => ConferenceSetting::get('camera_ready_deadline', '2025-11-15'),
            'registration_deadline' => ConferenceSetting::get('registration_deadline', '2025-12-01'),
            
            // Content
            'submission_guidelines' => ConferenceSetting::get('submission_guidelines', 'Papers should be submitted in PDF format, maximum 8 pages, using the provided template.'),
            'review_criteria' => ConferenceSetting::get('review_criteria', 'Papers will be reviewed based on originality, technical quality, clarity, and relevance.'),
        ];
        
        // Get keywords and convert to array
        $keywords = ConferenceSetting::get('keywords', 'Computer Science, Machine Learning, AI, Software Engineering, Data Science');
        $settings['keywords_array'] = array_map('trim', explode(',', $keywords));
        
        // Fetch reviewers (users with reviewer role)
        $reviewerRole = Roles::where('name', 'reviewer')->first();
        $reviewers = [];
        
        if ($reviewerRole) {
            $reviewers = User::where('role_id', $reviewerRole->id)
                ->select('id', 'name', 'last_name', 'email', 'phone')
                ->get();
        }
        
        return view('welcome', compact('settings', 'reviewers'));
    }
}
