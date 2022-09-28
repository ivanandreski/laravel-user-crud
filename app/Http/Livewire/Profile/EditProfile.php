<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Component
{
    public string $email;
    public string $name;

    public string $successMessage;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount() {
        $this->email = auth()->user()->email;
        $this->name = auth()->user()->name;
    }

    public function saveChanges() {
        $this->validate();

        $user = User::find(Auth::user()->id);
        $user->email = $this->email;
        $user->name = $this->name;
        $user->save();

        $this->successMessage = 'Details changed successfully';
    }

    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
}
