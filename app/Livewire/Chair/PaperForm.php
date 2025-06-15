<?php

namespace App\Livewire\Chair;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PaperForm extends Component
{
    use WithPagination;
    public function render()
    {
        $reviewers = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', 'reviewer');
            })
            ->orderBy('name')
            ->paginate(5);

        return view('livewire.chair.paper-form', [
            'reviewers' => $reviewers,
        ]);
    }


    public function submit()
    {
        $this->validate([
            'reviewer_id' => 'required|exists:users,id',
        ]);

        


    }
    

        
}
