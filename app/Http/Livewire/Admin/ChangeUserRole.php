<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class ChangeUserRole extends Component
{
    public string $userEmail, $userRole, $errorMessage;
    public $roles;

    private function resetFields() {
        $this->userEmail = '';
        $this->userRole = '';
        $this->errorMessage = '';
        $this->roles = Role::all();
    }

    public function mount() {
        $this->resetFields();
    }

    public function saveChanges() {
        $user = User::findByEmail($this->userEmail);
        if($user == null) {
            $this->errorMessage = "User not found!";
            return;
        }

        $role = Role::find($this->userRole);
        if($role == null) {
            $this->errorMessage = "Role not found!";
            return;
        }

        $user->role_id = $role->id;
        $user->save();
        $this->resetFields();
        $this->emit("parentUpdate");
    }

    public function render()
    {
        return view('livewire.admin.change-user-role')
            ->layout('livewire.layout.base');
    }
}
