<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class TambahKategori extends Component
{
    public $namaKategori;

    public function resetForm()
    {
        $this->namaKategori = "";
    }

    public function create()
    {
        $this->validate([
            "namaKategori" => "required|string",
        ]);

        Kategori::create([
            "nama_kategori" => $this->namaKategori,
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
        return view("livewire.kategori.tambah-kategori");
    }
}
