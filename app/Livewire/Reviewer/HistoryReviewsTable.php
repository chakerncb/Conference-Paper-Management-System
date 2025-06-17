<?php

namespace App\Livewire\Reviewer;

use Livewire\Component;
use Livewire\WithPagination;

class HistoryReviewsTable extends Component
{
     use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    // Review form properties
    public $showReviewForm = false;
    public $selectedReviewId = null;
    public $score = '';
    public $comments = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    protected $rules = [
        'score' => 'required|integer|min:1|max:10',
        'comments' => 'required|string|min:10|max:1000',
    ];

    protected $messages = [
        'score.required' => 'Score is required.',
        'score.integer' => 'Score must be a number.',
        'score.min' => 'Score must be at least 1.',
        'score.max' => 'Score must not exceed 10.',
        'comments.required' => 'Comments are required.',
        'comments.min' => 'Comments must be at least 10 characters.',
        'comments.max' => 'Comments must not exceed 1000 characters.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingSortField()
    {
        $this->resetPage();
    }

    public function updatingSortDirection()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->statusFilter = '';
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
        $this->perPage = 10;
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function clearStatusFilter()
    {
        $this->statusFilter = '';
        $this->resetPage();
    }

    public function openReviewForm($reviewId)
    {
        $this->selectedReviewId = $reviewId;
        $this->showReviewForm = true;
        $this->resetErrorBag();
        
        // Load existing review data if it exists
        $review = auth()->user()->reviews()->find($reviewId);
        if ($review) {
            $this->score = $review->score ?? '';
            $this->comments = $review->comments ?? '';
        }
    }

    public function closeReviewForm()
    {
        $this->showReviewForm = false;
        $this->selectedReviewId = null;
        $this->score = '';
        $this->comments = '';
        $this->resetErrorBag();
    }

    public function submitReview()
    {
        $this->validate();

        $review = auth()->user()->reviews()->find($this->selectedReviewId);
        
        if ($review) {
            $review->update([
                'score' => $this->score,
                'comments' => $this->comments,
            ]);

            session()->flash('message', 'Review submitted successfully!');
            $this->closeReviewForm();
        }
    }

    public function render()
    {
        $query = auth()->user()->reviews()
            ->whereNotNull('score') // Only completed reviews
            ->with('paper');

        // Apply search filter
        if (!empty($this->search)) {
            $query->whereHas('paper', function ($q) {
                $q->where('title', 'like', "%{$this->search}%");
                //   ->orWhere('abstract', 'like', "%{$this->search}%")
                //   ->orWhere('keywords', 'like', "%{$this->search}%");
            });
        }

        if (!empty($this->statusFilter)) {
            $query->whereHas('paper', function ($q) {
                $q->where('status', $this->statusFilter);
            });
        }
        $query->orderBy($this->sortField, $this->sortDirection);
        $reviews = $query->paginate($this->perPage);


        return view('livewire.reviewer.history-reviews-table' ,[
            'reviews' => $reviews
        ]);
    }
}
