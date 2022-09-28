<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserManager extends Component
{
    public $users;
    public $roles;

    public string $search;

    public $name, $email, $role;
    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'role' => 'required',
    ];

    public function resetFields() {
        $this->users = User::all();
        $this->roles = Role::all();
        $this->name = '';
        $this->email = '';
        $this->role = 1;
        $this->search = '';
    }

    public function mount() {
        $this->resetFields();
    }

    public function updatedSearch(){
        $this->users = User::where('name', 'like', '%' . $this->search . '%')->get(); 
     }

    public function addUser() {
        $this->validate();
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role_id = $this->role;
        $user->password = Hash::make('12345678');
        $user->save();

        $this->resetFields();
        $this->emit("parentUpdate");
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();

        $this->resetFields();
        $this->emit("parentUpdate");
    }

    public function render()
    {
        // dd($this->users);
        return view('livewire.admin.user-manager')
            ->layout('livewire.layout.base');
    }
}
