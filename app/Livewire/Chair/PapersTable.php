<?php

namespace App\Livewire\Chair;

use App\Models\Paper;
use App\Models\User;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PapersTable extends Component
{
    use WithPagination;
    
    public $showFormForPaper = null;
    public $searchTerm = '';
    public $selectedReviewers = [];
    public $currentPaperId = null;
    public $perPage = 10;
    public function render()
    {
        $papers = Paper::paginate($this->perPage);
        
        $reviewers = collect();
        if ($this->showFormForPaper) {
            $reviewers = User::with('role')
                ->whereHas('role', function ($query) {
                    $query->where('name', 'reviewer');
                })
                ->when($this->searchTerm, function ($query) {
                    $query->where(function ($q) {
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                          ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                    });
                })
                ->orderBy('name')
                ->paginate(5, ['*'], 'reviewersPage');
        }

        return view('livewire.chair.papers-table', [
            'papers' => $papers,
            'reviewers' => $reviewers
        ]);
    }

    public function changePerPage($value)
    {
        $this->perPage = $value;
        $this->resetPage();
    }

    public function deletepaper($paperId)
    {
        $paper = Paper::find($paperId);
        if ($paper) {
            $paper->delete();
            LivewireAlert::success()
                ->text('Paper deleted successfully')
                ->show();
        }
    }

    public function toggleReviewerForm($paperId)
    {
        if ($this->showFormForPaper === $paperId) {
            $this->showFormForPaper = null;
            $this->currentPaperId = null;
            $this->selectedReviewers = [];
            $this->searchTerm = '';
        } else {
            $this->showFormForPaper = $paperId;
            $this->currentPaperId = $paperId;
            $this->selectedReviewers = [];
            $this->searchTerm = '';
            // Reset reviewers pagination when opening the form
            $this->resetPage('reviewersPage');
        }
    }

    public function selectReviewer($reviewerId)
    {
        if (!in_array($reviewerId, $this->selectedReviewers)) {
            $this->selectedReviewers[] = $reviewerId;
        } elseif (in_array($reviewerId, $this->selectedReviewers)) {
            $this->selectedReviewers = array_diff($this->selectedReviewers, [$reviewerId]);
        }
    }

    public function submitReviewers()
    {
        $this->validate([
            'selectedReviewers' => 'required|array|min:2|max:2',
            'selectedReviewers.*' => 'exists:users,id',
        ]);

        // Here you would typically save the reviewer assignments
        // For now, just show a success message
        LivewireAlert::success()
            ->text('Reviewers assigned successfully' . 'Paper ID: ' . $this->currentPaperId . ', Reviewers: ' . implode(', ', $this->selectedReviewers))
            ->show();
            
        $this->showFormForPaper = null;
        $this->currentPaperId = null;
        $this->selectedReviewers = [];
        $this->searchTerm = '';
    }

    public function cancelReviewerSelection()
    {
        $this->showFormForPaper = null;
        $this->currentPaperId = null;
        $this->selectedReviewers = [];
        $this->searchTerm = '';
    }


     public function streamPdf($paper_id)
    {

        $paper = Paper::find($paper_id);
       
        if ($paper) {
          redirect()->route('paper.print',$paper->file_path);
        } else {
            LivewireAlert::error()
                ->text('Paper not found')
                ->show();
        }


    }
}
