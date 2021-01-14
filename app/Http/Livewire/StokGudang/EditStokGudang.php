<?php

namespace App\Http\Livewire\StokGudang;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditStokGudang extends Component
{
    public $idProduk;
    public $minStok;
    public $stok;
    public $idGudang;
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
        $this->idProduk = $data["id_produk"];
        $this->produk = $data["produk"]["nama_produk"];
        $this->minStok = $data["min_stok"];
        $this->stok = $data["stok"];
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
        return view("livewire.stok-gudang.edit-stok-gudang");
    }
}
