<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class ManageRoles extends Component
{
    public $roles;
    public string $newRole;

    private function resetFields() {
        $this->newRole = '';
        $this->errorMessage = '';
        $this->roles = Role::all();
    }

    public function mount() {
        $this->resetFields();
    }

    public function addNewRole() {
        $role = new Role();
        $role->role_name = $this->newRole;
        $role->save();

        $this->resetFields();
        $this->emit("parentUpdate");
    }

    public function deleteRole($roleId) {
        $role = Role::find($roleId);
        if($role != null) {
            $usersRoleChange = User::where('role_id', '=', $role->id)->get();
            foreach($usersRoleChange as $user) {
                $user->role_id = 1;
                $user->save();
            }

            $role->delete();
            $this->resetFields();
            $this->emit("parentUpdate");
        }
    }

    public function render()
    {
        return view('livewire.admin.manage-roles')
            ->layout('livewire.layout.base');
    }
}
