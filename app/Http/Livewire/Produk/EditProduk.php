<?php

namespace App\Http\Livewire\Produk;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Satuan;
use Livewire\Component;

class EditProduk extends Component
{
    public $kodeBarcode;
    public $namaProduk;
    public $idKategori;
    public $kategori;
    public $idSatuan;
    public $satuan;
    public $hargaModal;
    public $hargaJual;
    public $keterangan;
    public $daftarKategoriArr = [];
    public $daftarSatuanArr = [];
    public $idProduk;

    public function mount($idProduk)
    {
        $daftarSatuan = Satuan::all();
        $daftarKategori = Kategori::all();

        foreach ($daftarKategori as $dt) {
            $this->daftarKategoriArr[] = [
                "key" => $dt->id_kategori,
                "value" => $dt->nama_kategori,
            ];
        }

        foreach ($daftarSatuan as $dt) {
            $this->daftarSatuanArr[] = [
                "key" => $dt->id_satuan,
                "value" => $dt->nama_satuan,
            ];
        }

        $modelProduk = Produk::where(["id_produk" => $idProduk])->first();
        $this->idProduk = $modelProduk->id_produk;
        $this->kodeBarcode = $modelProduk->kode_barcode;
        $this->namaProduk = $modelProduk->nama_produk;
        $this->kategori = $modelProduk->kategori->nama_kategori;
        $this->idKategori = $modelProduk->id_kategori;
        $this->satuan = $modelProduk->satuan->nama_satuan;
        $this->idSatuan = $modelProduk->id_satuan;
        $this->hargaModal = $modelProduk->harga_modal;
        $this->hargaJual = $modelProduk->harga_jual;
        $this->keterangan = $modelProduk->keterangan;
    }

    protected $listeners = [
        "selectedKategori",
        "selectedSatuan",
        "inputRupiahHargaModal",
        "inputRupiahHargaJual",
    ];

    public function inputRupiahHargaModal($value)
    {
        $this->hargaModal = $value;
    }
    public function inputRupiahHargaJual($value)
    {
        $this->hargaJual = $value;
    }

    public function selectedKategori($value)
    {
        $this->idKategori = $value;
    }
    public function selectedSatuan($value)
    {
        $this->idSatuan = $value;
    }

    public function resetForm()
    {
        $this->kodeBarcode = "";
        $this->namaProduk = "";
        $this->idKategori = "";
        $this->idSatuan = "";
        $this->hargaModal = "";
        $this->hargaJual = "";
        $this->keterangan = "";
    }

    public function update()
    {
        $this->validate([
            "kodeBarcode" => "required",
            "namaProduk" => "required",
            "idKategori" => "required",
            "idSatuan" => "required",
            "hargaModal" => "required",
            "hargaJual" => "required",
        ]);

        $modelProduk = Produk::where(["id_produk" => $this->idProduk])->first();
        $modelProduk->update([
            "kode_barcode" => $this->kodeBarcode,
            "nama_produk" => $this->namaProduk,
            "id_kategori" => $this->idKategori,
            "id_satuan" => $this->idSatuan,
            "harga_modal" => $this->hargaModal,
            "harga_jual" => $this->hargaJual,
            "keterangan" => $this->keterangan,
        ]);

        // session()->flash("message", "Post successfully updated.");
        request()
            ->session()
            ->flash("success", "Berhasil menambahkan produk.");

        return redirect()->to("/produk");
    }

    public function render()
    {
        return view("livewire.produk.edit-produk");
    }
}
