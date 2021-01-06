<?php

namespace App\Http\Livewire\Produk;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Satuan;
use Livewire\Component;

class TambahProduk extends Component
{
    public $kodeBarcode;
    public $namaProduk;
    public $idKategori;
    public $idSatuan;
    public $hargaModal;
    public $hargaJual;
    public $diskon;
    public $minimalDiskon;
    public $keterangan;
    public $daftarKategoriArr = [];
    public $daftarSatuanArr = [];

    public function mount()
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
    }

    protected $listeners = [
        "selectedKategori",
        "selectedSatuan",
        "inputRupiahHargaModal",
        "inputRupiahDiskon",
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
    public function inputRupiahDiskon($value)
    {
        $this->diskon = $value;
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
        $this->diskon = "";
        $this->minimalDiskon = "";
        $this->keterangan = "";
    }

    public function create()
    {
        $this->validate([
            "kodeBarcode" => "required",
            "namaProduk" => "required",
            "idKategori" => "required",
            "idSatuan" => "required",
            "hargaModal" => "required",
            "hargaJual" => "required",
            "diskon" => "required",
            "minimalDiskon" => "required",
        ]);

        Produk::create([
            "kode_barcode" => $this->kodeBarcode,
            "nama_produk" => $this->namaProduk,
            "id_kategori" => $this->idKategori,
            "id_satuan" => $this->idSatuan,
            "harga_modal" => $this->hargaModal,
            "harga_jual" => $this->hargaJual,
            "diskon" => $this->diskon,
            "min_jumlah_diskon" => $this->minimalDiskon,
            "keterangan" => $this->keterangan,
        ]);

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil menambahkan data",
        ]);

        return redirect()->to("/produk");
    }

    public function render()
    {
        return view("livewire.produk.tambah-produk");
    }
}
