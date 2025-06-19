<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\ConferenceSetting;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('author.myPapers');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $deadLines = [
            'submission' => ConferenceSetting::get('submission_deadline', 'Not Set'),
            'review' => ConferenceSetting::get('review_deadline', 'Not Set'),
            'camera_ready' => ConferenceSetting::get('camera_ready_deadline', 'Not Set'),
            'registration' => ConferenceSetting::get('registration_deadline', 'Not Set'),
        ];

        return view('author.submitPaper', compact('deadLines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
