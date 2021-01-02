<?php

namespace App\Http\Livewire\Satuan;

use App\Models\Satuan;
use Livewire\Component;

class TambahSatuan extends Component
{
    public $namaSatuan;

    public function resetForm()
    {
        $this->namaSatuan = "";
    }

    public function create()
    {
        $this->validate([
            "namaSatuan" => "required|string",
        ]);

        Satuan::create([
            "nama_satuan" => $this->namaSatuan,
        ]);
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil menambahkan data",
        ]);

        $this->emit("hideModal");

        $this->resetForm();

        $this->emit("refreshData");
    }

    public function render()
    {
        return view("livewire.satuan.tambah-satuan");
    }
}
