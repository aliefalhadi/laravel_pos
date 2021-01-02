<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditKategori extends Component
{
    public $idKategori;
    public $namaKategori;

    protected $listeners = ["updateData"];

    public function updateData($data)
    {
        $this->idKategori = $data["id_kategori"];
        $this->namaKategori = $data["nama_kategori"];
    }

    public function update()
    {
        $this->validate([
            "namaKategori" => "required",
        ]);

        $user = Kategori::where(["id_kategori" => $this->idKategori])->first();

        $user->update([
            "nama_kategori" => $this->namaKategori,
        ]);

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil edit data",
        ]);

        $this->emit("hideModalEdit");

        $this->emit("refreshData");
    }

    public function render()
    {
        return view("livewire.kategori.edit-kategori");
    }
}
