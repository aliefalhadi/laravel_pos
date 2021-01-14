<?php

namespace App\Http\Livewire\StokGudang;

use App\Models\Produk;
use App\Models\StokGudang;
use Livewire\Component;

class TambahStokGudang extends Component
{
    public $idProduk;
    public $minStok;
    public $stok;
    public $idGudang;
    public $daftarProduk;
    public $initialValue = "";

    protected $listeners = ["selectedProduk"];

    public function mount($idGudang)
    {
        $this->idGudang = $idGudang;

        $daftarProduk = Produk::select("produk.*")
            ->leftJoin(
                "stok_gudang",
                "stok_gudang.id_produk",
                "=",
                "produk.id_produk"
            )
            ->whereNull("stok_gudang.id_stok_gudang")
            ->get();

        if ($daftarProduk->count() > 0) {
            foreach ($daftarProduk as $dt) {
                $this->daftarProduk[] = [
                    "key" => $dt->id_produk,
                    "value" =>
                        $dt->nama_produk .
                        " (" .
                        $dt->satuan->nama_satuan .
                        ")",
                ];
            }
        } else {
            $this->daftarProduk[] = [
                "key" => "",
                "value" => "Data kosong",
            ];
        }
    }

    public function selectedProduk($value)
    {
        $this->idProduk = $value;
    }

    public function resetForm()
    {
        $this->initialValue = "";
        $this->idProduk = "";
        $this->minStok = "";
        $this->stok = "";
    }

    public function create()
    {
        $this->validate([
            "idProduk" => "required",
            "minStok" => "required|integer",
            "stok" => "required|integer",
        ]);

        StokGudang::create([
            "id_gudang" => $this->idGudang,
            "id_produk" => $this->idProduk,
            "min_stok" => $this->minStok,
            "stok" => $this->stok,
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
        return view("livewire.stok-gudang.tambah-stok-gudang");
    }
}
