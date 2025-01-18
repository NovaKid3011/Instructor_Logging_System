<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public function render()
    {
        sleep(2);
        return view('livewire.counter');
    }
}
