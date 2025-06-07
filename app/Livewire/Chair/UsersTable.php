<?php

namespace App\Livewire\Chair;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function render()
    {
        $users = User::paginate($this->perPage);

        return view('livewire.chair.users-table' , [
            'users' => $users,
        ]);
    }

    public function changePerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->resetPage();
    }
}
