<?php

namespace App\Livewire\Chair;

use App\Models\User;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $perPage = 10;

    protected $listeners = ['user-created' => '$refresh', 'user-updated' => '$refresh'];

    public function render()
    {
        $users = User::with('role')->paginate($this->perPage);

        return view('livewire.chair.users-table' , [
            'users' => $users,
        ]);
    }

    public function changePerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->resetPage();
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            LivewireAlert::success()
                ->text('User deleted successfully')
                ->show();
        }
    }

    public function editUser($userId)
    {
        $this->dispatch('open-modal', ['component' => 'chair.create-user', 'userId' => $userId, 'mode' => 'edit']);
    }

    public function openCreateUserModal()
    {
        $this->dispatch('open-modal', ['component' => 'chair.create-user']);
    }


}
