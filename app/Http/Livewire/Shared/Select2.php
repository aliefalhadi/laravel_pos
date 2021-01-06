<?php

namespace App\Http\Livewire\Shared;

use Livewire\Component;

class Select2 extends Component
{
    public $select = "";
    public $selectValue = "";
    public $listenFunction = ""; // nama function yang akan diemit ketika onclick list
    public $options = "";
    public $placeholder = "";
    // public $options = [
    //     [
    //         "key" => "1",
    //         "value" => "sabun",
    //     ],
    //     [
    //         "key" => "2",
    //         "value" => "sayuran",
    //     ],
    //     [
    //         "key" => "3",
    //         "value" => "meja",
    //     ],
    //     [
    //         "key" => "4",
    //         "value" => "kursi",
    //     ],
    // ];

    public function mount($options, $listenFunction, $placeholder)
    {
        $this->options = $options;
        $this->listenFunction = $listenFunction;
        $this->placeholder = $placeholder;
    }

    public function selected($option)
    {
        $this->select = $option["value"];
        $this->emit($this->listenFunction, $option["key"]);
    }

    public function render()
    {
        return view("livewire.shared.select2");
    }
}
