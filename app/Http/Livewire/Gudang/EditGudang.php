<?php

namespace App\Http\Livewire\Gudang;

use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditGudang extends Component
{
    public $idGudang;
    public $namaGudang;

    protected $listeners = ["updateData"];

    public function updateData($data)
    {
        $this->idGudang = $data["id_gudang"];
        $this->namaGudang = $data["nama_gudang"];
    }

    public function update()
    {
        $this->validate([
            "namaGudang" => "required",
        ]);

        $user = Gudang::where(["id_gudang" => $this->idGudang])->first();

        $user->update([
            "nama_gudang" => $this->namaGudang,
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
        return view("livewire.gudang.edit-gudang");
    }
}
