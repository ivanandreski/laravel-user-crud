<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RedirectHome extends Component
{
    public function mount() {
        return redirect("/");
    }

    public function render()
    {
        return view('livewire.redirect-home')->layout('livewire.layout.base');
    }
}
