<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ChangePassword extends Component
{
    public string $currentPassword;
    public string $password;
    public string $password_confirmation;

    public string $currentPasswordError;
    public string $successMessage;

    protected $rules = [
        'password' => 'required|min:8',
        'password_confirmation' => 'required|same:password'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetFields() {
        $this->currentPassword = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function mount() {
        $this->resetFields();
    }

    public function saveChanges() {
        $user = User::find(Auth::user()->id);
        $this->validate();
        if (!Hash::check($this->currentPassword, $user->password)) {
            $this->currentPasswordError = "Invalid current password!";
            return;
        }

        $user->password = Hash::make($this->password);
        $user->save();
        $this->currentPasswordError = "";
        $this->successMessage = "Changes saved successfully!";
        $this->resetFields();
    }

    public function render()
    {
        return view('livewire.profile.change-password');
    }
}
