<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DeleteProfile extends Component
{
    public string $password;

    public string $errorMessage;

    public function mount() {
        $this->password = '';
        $this->errorMessage = '';
    }

    public function deleteProfile() {
        $user = User::find(Auth::user()->id);
        if (!Hash::check($this->password, $user->password)) {
            $this->errorMessage = "Invalid password!";
            return;
        }

        Auth::logout();

        if ($user->delete()) {
            return redirect('/')->with('global', 'Your account has been deleted!');
        }
    }

    public function render()
    {
        return view('livewire.profile.delete-profile')
            ->layout('livewire.layout.base');
    }
}
