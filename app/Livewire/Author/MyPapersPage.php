<?php

namespace App\Livewire\Author;

use App\Models\Paper;
use Livewire\Component;
use Livewire\WithPagination;

class MyPapersPage extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $selectedPaper = null;
    public $showReviewsModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
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

    public function viewReviews($paperId)
    {
        $this->selectedPaper = Paper::with(['reviews.reviewer'])->findOrFail($paperId);
        $this->showReviewsModal = true;
    }

    public function closeReviewsModal()
    {
        $this->showReviewsModal = false;
        $this->selectedPaper = null;
    }

    public function render()
    {
        $query = Paper::where('author_id', auth()->id())
            ->with(['reviews.reviewer']);

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
                //   ->orWhere('abstract', 'like', '%' . $this->search . '%')
                //   ->orWhere('keywords', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }
        $query->orderBy($this->sortField, $this->sortDirection);
        $papers = $query->paginate($this->perPage);

        return view('livewire.author.my-papers-page', [
            'papers' => $papers,
        ]);
    }
}
