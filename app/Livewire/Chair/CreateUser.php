<?php

namespace App\Livewire\Chair;

use App\Mail\NewUserEmail;
use App\Models\User;
use App\Models\Roles;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Mail;
use Str;

class CreateUser extends Component
{
    public $name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $role_id = '';
    public $userId = null;
    public $isEditMode = false;

    protected $listeners = ['user-created' => '$refresh', 'open-modal' => 'handleModalOpen'];

    public function mount()
    {
        $this->resetForm();
    }

    public function handleModalOpen($data = null)
    {
        if (isset($data['component']) && $data['component'] === 'chair.create-user') {
            if (isset($data['userId']) && isset($data['mode']) && $data['mode'] === 'edit') {
                $this->loadUserForEdit($data['userId']);
            } else {
                $this->resetForm();
            }
        }
    }

    public function loadUserForEdit($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->role_id = $user->role_id;
            $this->isEditMode = true;
        }
    }

    public function resetForm()
    {
        $this->name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->role_id = '';
        $this->userId = null;
        $this->isEditMode = false;
        $this->resetValidation();
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($this->isEditMode ? ',' . $this->userId : ''),
            'phone' => 'nullable|string|max:10',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            'phone.max' => 'Phone number cannot exceed 10 characters.',
            'role_id.required' => 'Please select a role.',
            'role_id.exists' => 'Selected role is invalid.',
        ];
    }

    public function createUser()
    {
        $this->validate();

        try {
            if ($this->isEditMode) {
                // Update existing user
                $user = User::find($this->userId);
                if ($user) {
                    $user->name = $this->name;
                    $user->last_name = $this->last_name;
                    $user->email = $this->email;
                    $user->phone = $this->phone;
                    $user->role_id = $this->role_id;
                    $user->save();

                    LivewireAlert::success()
                        ->title('Success!')
                        ->text('User updated successfully.')
                        ->show();

                    $this->dispatch('user-updated');
                }
            } else {
                // Create new user

                $password = Str::random(10); 

                $user = new User();
                $user->name = $this->name;
                $user->last_name = $this->last_name;
                $user->email = $this->email;
                $user->phone = $this->phone;
                $user->role_id = $this->role_id;
                $user->password = Hash::make($password); 
                $user->save();

                try {

                Mail::to($this->email)->send(new NewUserEmail([
                    'name' => $this->name,
                    'last_name' => $this->last_name,
                    'email' => $this->email,
                    'password' => $password, 
                ]));

                } catch (\Exception $e) {
                    LivewireAlert::error()
                        ->title('Email Error!')
                        ->text('Failed to send email. Please check your email configuration.')
                        ->show();
                    return;
                }

                LivewireAlert::success()
                    ->title('Success!')
                    ->text('User created successfully.')
                    ->show();

                $this->dispatch('user-created');
            }

            $this->resetForm();
            $this->dispatch('close-modal');
            
        } catch (\Exception $e) {
            LivewireAlert::error()
                ->title('Error!')
                ->text('Failed to ' . ($this->isEditMode ? 'update' : 'create') . ' user. Please try again.')
                ->show();
        }
    }

    public function render()
    {
        $roles = Roles::all();
        
        return view('livewire.chair.create-user', [
            'roles' => $roles
        ]);
    }
}
