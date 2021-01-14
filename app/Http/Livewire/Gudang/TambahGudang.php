<?php

namespace App\Http\Livewire\Gudang;

use App\Models\Gudang;
use Livewire\Component;

class TambahGudang extends Component
{
    public $namaGudang;

    public function resetForm()
    {
        $this->namaGudang = "";
    }

    public function create()
    {
        $this->validate([
            "namaGudang" => "required|string",
        ]);

        Gudang::create([
            "nama_gudang" => $this->namaGudang,
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
        return view("livewire.gudang.tambah-gudang");
    }
}
