<?php

namespace App\Livewire\Author;

use App\Models\Paper;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubmitPaperForm extends Component
{
    use WithFileUploads;
    public $title;
    public $abstract;
    public $keywords;
    public $file;
    public $agreements = [
        'agr-1' => false, // I confirm that this paper follows the IEEE conference template and submission guidelines
        'agr-2' => false, // I certify that this work is original and has not been published elsewhere
        'agr-3' => false, // I understand and agree to the double-blind peer review process
    ];


    public function render()
    {
        return view('livewire.author.submit-paper-form');
    }

    public function submit()
    {

       $messages = [
            'title.required' => 'The title is required.',
            'abstract.required' => 'The abstract is required.',
            'keywords.required' => 'Keywords are required.',
            'file.required' => 'A file is required.',
            'file.mimes' => 'The file must be a PDF.',
            'file.max' => 'The file may not be greater than 2MB.',
            'agreements.agr-1.accepted' => 'You must accept all agreements.',
            'agreements.agr-2.accepted' => 'You must accept all agreements.',
            'agreements.agr-3.accepted' => 'You must accept all agreements.',
        ];


        $this->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required|string|max:1000',
            'keywords' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048', // 2MB max
            'agreements.agr-1' => 'accepted',
            'agreements.agr-2' => 'accepted',
            'agreements.agr-3' => 'accepted',
        ], $messages);


        if ($this->agreements['agr-1'] === false || $this->agreements['agr-2'] === false || $this->agreements['agr-3'] === false) {
            LivewireAlert::error()
                ->title('Agreements Not Accepted')
                ->text('You must accept all agreements to submit your paper.')
                ->show();
            return;
        }

        $paper = new Paper();
        $paper->author_id = auth()->id();
        $paper->title = $this->title;
        $paper->abstract = $this->abstract;
        $paper->keywords = $this->keywords;
        $paper->file_path = $this->file->store('papers', 'public');
        $paper->status = 'Submitted';
        $paper->save();

        

        $this->reset(['title', 'abstract', 'keywords', 'file', 'agreements']);
        
        LivewireAlert::success()
            ->title('Success')
            ->text('Your paper has been submitted successfully!')
            ->show();

        return;
    }
}
