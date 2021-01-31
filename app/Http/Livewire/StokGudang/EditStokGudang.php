<?php

namespace App\Http\Livewire\StokGudang;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\StokGudang;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditStokGudang extends Component
{
    public $idProduk;
    public $minStok;
    public $stok;
    public $idGudang;
    public $idStokGudang;
    public $daftarProduk;
    public $produk = "";

    protected $listeners = ["updateData"];

    public function mount()
    {
        $daftarProduk = Produk::all();

        foreach ($daftarProduk as $dt) {
            $this->daftarProduk[] = [
                "key" => $dt->id_produk,
                "value" =>
                    $dt->nama_produk . " (" . $dt->satuan->nama_satuan . ")",
            ];
        }
    }

    public function updateData($data)
    {
        $this->idStokGudang = $data["id_stok_gudang"];
        $this->idProduk = $data["id_produk"];
        $this->idGudang = $data["id_gudang"];
        $this->produk = $data["produk"]["nama_produk"];
        $this->minStok = $data["min_stok"];
        $this->stok = $data["stok"];
    }

    public function update()
    {
        $this->validate([
            "minStok" => "required|integer",
            "stok" => "required|integer",
        ]);

        $model = StokGudang::where([
            "id_stok_gudang" => $this->idStokGudang,
        ])->first();

        $model->update([
            "min_stok" => $this->minStok,
            "stok" => $this->stok,
        ]);
        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil update data",
        ]);

        $this->emit("hideModalEdit");

        $this->emit("refreshData");
    }

    public function render()
    {
        return view("livewire.stok-gudang.edit-stok-gudang");
    }
}
