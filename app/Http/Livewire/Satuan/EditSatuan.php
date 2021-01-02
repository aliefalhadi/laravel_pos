<?php

namespace App\Http\Livewire\Satuan;

use App\Models\Satuan;
use Livewire\Component;

class EditSatuan extends Component
{
    public $idSatuan;
    public $namaSatuan;

    protected $listeners = ["updateData"];

    public function updateData($data)
    {
        $this->idSatuan = $data["id_satuan"];
        $this->namaSatuan = $data["nama_satuan"];
    }

    public function update()
    {
        $this->validate([
            "namaSatuan" => "required",
        ]);

        $user = Satuan::where(["id_satuan" => $this->idSatuan])->first();

        $user->update([
            "nama_satuan" => $this->namaSatuan,
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
        return view("livewire.satuan.edit-satuan");
    }
}
