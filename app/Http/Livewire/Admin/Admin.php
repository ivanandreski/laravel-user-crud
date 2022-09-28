<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Admin extends Component
{
    protected $listeners = [
        'parentUpdate'
    ];
    
    public function parentUpdate()
    {
       $this->mount();
       $this->render();
    }

    public function render()
    {
        return view('livewire.admin.admin')
            ->layout('livewire.layout.base');
    }
}
