<?php

namespace App\Livewire\Author;

use App\Models\Paper;
use Livewire\Component;

class MyPapersPage extends Component
{
    public function render()
    {
        $papers = Paper::where('author_id', auth()->id())
            ->with(['reviews.reviewer'])
            ->orderBy('created_at',)
            ->paginate(10);


        return view('livewire.author.my-papers-page' ,
            [
                'papers' => $papers,
            ]);
    }
}
