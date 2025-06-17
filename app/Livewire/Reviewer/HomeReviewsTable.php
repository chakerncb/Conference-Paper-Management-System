<?php

namespace App\Livewire\Reviewer;

use Livewire\Component;

class HomeReviewsTable extends Component
{
    public function render()
    {
        $reviews = auth()->user()->reviews()
            ->with('paper')
            ->whereNull('score') // Only pending reviews
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('livewire.reviewer.home-reviews-table', [
            'reviews' => $reviews,
        ]);
    }
}
