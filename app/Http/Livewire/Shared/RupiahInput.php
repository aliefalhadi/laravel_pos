<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;

class RupiahInput extends Component
{
    public $listenFunction = "";
    public $placeholder = "";
    public $initialValue = "";
    public $idEl = "";

    public function mount($listenFunction, $placeholder, $initialValue = "", $idEl="")
    {
        $this->placeholder = $placeholder;
        $this->listenFunction = $listenFunction;
        $this->initialValue = $initialValue;
        $this->idEl = $idEl;
    }
    public function formatRupiah($value)
    {
        $value = str_replace("Rp. ", "", $value);
        $value = str_replace(".", "", $value);
        $this->emit($this->listenFunction, $value);
    }
    public function render()
    {
        return view("livewire.shared.rupiah-input");
    }
}
