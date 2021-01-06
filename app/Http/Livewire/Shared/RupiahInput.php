<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;

class RupiahInput extends Component
{
    public $listenFunction = "";
    public $placeholder = "";

    public function mount($listenFunction, $placeholder)
    {
        $this->placeholder = $placeholder;
        $this->listenFunction = $listenFunction;
    }
    public function formatRupiah($value)
    {
        $this->emit($this->listenFunction, $value);
    }
    public function render()
    {
        return view("livewire.shared.rupiah-input");
    }
}
