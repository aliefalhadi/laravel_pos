<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Produk;
use App\Models\StokGudang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TambahTransaksiGudang extends Component
{
    public $kodeBarcode;
    public $namaProduk;
    public $idKategori;
    public $idSatuan;
    public $hargaModal;
    public $hargaJual;
    public $idGudang;
    public $keterangan;
    public $totalTransaksi = 0;
    public $totalBayar = 0;
    public $totalKembalian = 0;
    public $diskonBayar = 0;
    public $daftarKategoriArr = [];
    public $daftarProdukTransaksi = [];
    public $daftarSatuanArr = [];
    public $searchProduk;

    public function mount($idGudang)
    {
        $this->idGudang = $idGudang;
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
        "inputRupiahTotalBayar",
        "inputRupiahDiskonBayar",
    ];

    public function inputRupiahTotalBayar($value)
    {
        $this->totalBayar = $value;
        $this->bayar();
    }

    public function inputRupiahDiskonBayar($value)
    {
        $this->diskonBayar = $value;
        $this->totalTransaksi = $this->totalTransaksi - $this->diskonBayar;
        $this->bayar();
    }

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
                    "harga_modal" => $produk->harga_modal,
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
        if (empty($this->daftarProdukTransaksi)) {
            $this->totalBayar = 0;
            $this->diskonBayar = 0;
            $this->totalKembalian = 0;
        }
    }

    public function bayar()
    {
        $this->totalKembalian = $this->totalBayar -  $this->totalTransaksi;
    }

    public function lihatProduk()
    {
        $this->emit("showModal");
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

    public function create()
    {
        $idTransaksi = "TS" . date("mdHis");
        Transaksi::create([
            "id_transaksi" => $idTransaksi,
            "id_gudang" => $this->idGudang,
            "id_kasir" => Auth::user()->id,
            "tgl_transaksi" => date("Y-m-d H:i:s"),
            "diskon_bayar" => $this->diskonBayar,
            "status" => 1,
        ]);

        //detail transaksi
        foreach ($this->daftarProdukTransaksi as $dt) {
            TransaksiDetail::create([
                "id_transaksi" => $idTransaksi,
                "id_produk" => $dt["id_produk"],
                "harga_modal" => $dt["harga_modal"],
                "harga" => $dt["harga_jual"],
                "quantity" => $dt["qty"],
            ]);
            //kuramgi stok barang
            $modelStokGudang = StokGudang::where(["id_gudang" => $this->idGudang, "id_produk" => $dt["id_produk"]])->first();
            $stok = $modelStokGudang->stok -  $dt["qty"];
            $modelStokGudang->update([
                "stok" => $stok,
            ]);
        }

        // session()->flash("message", "Post successfully updated.");
        request()
            ->session()
            ->flash("success", "Berhasil menambahkan transaksi.");


        return redirect()->to("/transaksi/" . $this->idGudang . "/tambah");
    }

    public function render()
    {
        return view("livewire.transaksi.tambah-transaksi-gudang");
    }
}
