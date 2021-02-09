<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Produk;
use Livewire\Component;

class TambahTransaksiGudang extends Component
{
    public $kodeBarcode;
    public $namaProduk;
    public $idKategori;
    public $idSatuan;
    public $hargaModal;
    public $hargaJual;
    public $keterangan;
    public $totalTransaksi = 0;
    public $daftarKategoriArr = [];
    public $daftarProdukTransaksi = [];
    public $daftarSatuanArr = [];
    public $searchProduk;

    public function mount()
    {
        // $daftarSatuan = Satuan::all();
        // $daftarKategori = Kategori::all();

        // foreach ($daftarKategori as $dt) {
        //     $this->daftarKategoriArr[] = [
        //         "key" => $dt->id_kategori,
        //         "value" => $dt->nama_kategori,
        //     ];
        // }

        // foreach ($daftarSatuan as $dt) {
        //     $this->daftarSatuanArr[] = [
        //         "key" => $dt->id_satuan,
        //         "value" => $dt->nama_satuan,
        //     ];
        // }
    }

    protected $listeners = [
        "selectedSatuan",
        "inputRupiahHargaModal",
        "inputRupiahHargaJual",
    ];

    public function addProduk()
    {
        $cekProduk = array_search(
            $this->searchProduk,
            array_column($this->daftarProdukTransaksi, "kode_barcode")
        );
        if (is_int($cekProduk)) {
            $this->daftarProdukTransaksi[$cekProduk]["qty"] =
                $this->daftarProdukTransaksi[$cekProduk]["qty"] + 1;

            $this->hitungTotal();
        } else {
            $produk = Produk::where([
                "kode_barcode" => $this->searchProduk,
            ])->first();
            if ($produk != null) {
                $pr = [
                    "id_produk" => $produk->id_produk,
                    "kode_barcode" => $produk->kode_barcode,
                    "nama_produk" => $produk->nama_produk,
                    "harga_jual" => $produk->harga_jual,
                    "qty" => 1,
                ];
                $this->daftarProdukTransaksi[] = $pr;

                $this->hitungTotal();
            }
        }
        $this->searchProduk = "";
    }

    public function hapusProdukTransaksi($kodeBarcode)
    {
        $indexProduk = array_search(
            $kodeBarcode,
            array_column($this->daftarProdukTransaksi, "kode_barcode")
        );

        unset($this->daftarProdukTransaksi[$indexProduk]);

        $this->hitungTotal();
    }

    public function hitungTotal()
    {
        $this->totalTransaksi = 0;
        foreach ($this->daftarProdukTransaksi as $dt) {
            $this->totalTransaksi += $dt["qty"] * $dt["harga_jual"];
        }
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

    public function create($type)
    {
        $this->validate([
            "kodeBarcode" => "required",
            "namaProduk" => "required",
            "idKategori" => "required",
            "idSatuan" => "required",
            "hargaModal" => "required",
            "hargaJual" => "required",
        ]);

        Produk::create([
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

        if ($type == "index") {
            return redirect()->to("/produk");
        } elseif ($type == "tambah") {
            return redirect()->to("/produk/tambah");
        }
    }

    public function render()
    {
        return view("livewire.transaksi.tambah-transaksi-gudang");
    }
}
