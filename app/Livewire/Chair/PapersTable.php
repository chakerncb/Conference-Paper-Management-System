<?php

namespace App\Livewire\Chair;

use App\Models\Paper;
use App\Models\User;
use App\Models\Review;
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

    public $expandedAbstracts = [];

    public function render()
    {
        $papers = Paper::with(['author', 'reviews.reviewer'])->paginate($this->perPage);
        
        $reviewers = collect();
        if ($this->showFormForPaper) {
            // Get current paper's assigned reviewers to exclude them from selection
            $currentPaper = Paper::find($this->showFormForPaper);
            $assignedReviewerIds = $currentPaper ? $currentPaper->reviews()->pluck('reviewer_id')->toArray() : [];
            
            $reviewers = User::with('role')
                ->whereHas('role', function ($query) {
                    $query->where('name', 'reviewer');
                })
                ->whereNotIn('id', $assignedReviewerIds) // Exclude already assigned reviewers
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

    public function toggleAbstract($paperId)
    {
        if (isset($this->expandedAbstracts[$paperId]) && $this->expandedAbstracts[$paperId]) {
            $this->expandedAbstracts[$paperId] = false;
        } else {
            $this->expandedAbstracts[$paperId] = true;
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

        try {
            $paper = Paper::findOrFail($this->currentPaperId);
            
            $existingReviewers = $paper->reviews()->pluck('reviewer_id')->toArray();
            $newReviewers = array_diff($this->selectedReviewers, $existingReviewers);
            
            if (empty($newReviewers)) {
                LivewireAlert::warning()
                    ->text('These reviewers are already assigned to this paper.')
                    ->show();
                return;
            }
            
            foreach ($this->selectedReviewers as $reviewerId) {
                if (!in_array($reviewerId, $existingReviewers)) {
                    Review::create([
                        'paper_id' => $this->currentPaperId,
                        'reviewer_id' => $reviewerId,
                        'score' => null, 
                        'comments' => null 
                    ]);
                }
            }
            
            $paper->update(['status' => 'Under Review']);            
            $reviewerNames = User::whereIn('id', $this->selectedReviewers)->pluck('name')->implode(', ');
            
            LivewireAlert::success()
                ->text("Reviewers assigned successfully! Paper \"{$paper->title}\" has been assigned to: {$reviewerNames}")
                ->show();
                
        } catch (\Exception $e) {
            LivewireAlert::error()
                ->text('Failed to assign reviewers. Please try again.')
                ->show();
        }
            
        // Reset form
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
