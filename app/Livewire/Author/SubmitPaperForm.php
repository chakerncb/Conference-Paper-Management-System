<?php

namespace App\Livewire\Author;

use App\Models\ConferenceSetting;
use App\Models\Paper;
use App\Models\Tag;
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

    public $MaxFileSize =  2; // Default to 2MB if not set
    public $agreements = [
        'agr-1' => false, // I confirm that this paper follows the IEEE conference template and submission guidelines
        'agr-2' => false, // I certify that this work is original and has not been published elsewhere
        'agr-3' => false, // I understand and agree to the double-blind peer review process
    ];
    
    protected $rules = [
        'title' => 'required|string|max:255',
        'abstract' => 'required|string|max:1000',
        'keywords' => 'required|string|max:255',
        'agreements.agr-1' => 'accepted',
        'agreements.agr-2' => 'accepted',
        'agreements.agr-3' => 'accepted',
    ];
    
    protected $messages = [
        'title.required' => 'The title is required.',
        'abstract.required' => 'The abstract is required.',
        'keywords.required' => 'Keywords are required.',
        'file.required' => 'A file is required.',
        'file.mimes' => 'The file must be a PDF.',
        'file.max' => 'The file may not be greater than the maximum allowed size.',
        'agreements.agr-1.accepted' => 'You must accept all agreements.',
        'agreements.agr-2.accepted' => 'You must accept all agreements.',
        'agreements.agr-3.accepted' => 'You must accept all agreements.',
    ];
    
    public function render()
    {
 
        $tags = Tag::all();
        $this->MaxFileSize = ConferenceSetting::get('max_paper_size_mb');

        return view('livewire.author.submit-paper-form', [
            'tags' => $tags,
        ]);
    }

    public function updated($propertyName)
    {
        $fileRule = 'required|file|mimes:pdf|max:' . ($this->MaxFileSize * 1024);
        $this->rules['file'] = $fileRule;
        
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $fileRule = 'required|file|mimes:pdf|max:' . ($this->MaxFileSize * 1024);
        $this->rules['file'] = $fileRule;

        $this->validate();

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
        $fileName = $this->file->store('/' , 'papers');
        $paper->file_path = $fileName;
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
