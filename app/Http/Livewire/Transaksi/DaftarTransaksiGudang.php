<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Produk;
use App\Models\Transaksi;
use Livewire\Component;

class DaftarTransaksiGudang extends Component
{
    // public $daftarUser =[];
    public $page = 1;
    public $limit = 10;
    public $sort = "desc";
    public $sortField = "created_at";
    public $c = "";
    public $searchKasir;
    public $searchTglTransaksi;
    public $searchStatus;
    public $idGudang;

    protected $listeners = ["refreshData"];

    public function mount($idGudang)
    {
        $this->idGudang = $idGudang;
    }

    public function nextPage()
    {
        $this->page++;
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function changeSort($field)
    {
        if ($this->sort == "asc") {
            $this->sort = "desc";
        } else {
            $this->sort = "asc";
        }
        $this->sortField = $field;
    }

    public function refreshData()
    {
        // Refresh if the argument is NULL or is the product ID
        $this->c = "asdasd";
    }

    public function tambahData()
    {
        $this->emit("showModal");
    }

    public function editData($data)
    {
        $this->emit("updateData", $data);
        $this->emit("showModalEdit");
    }

    public function deleteData($id)
    {
        $kategori = Produk::where(["id_produk" => $id]);

        $kategori->delete();

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil hapus data",
        ]);
    }

    public function render()
    {
        $daftarData = Transaksi::where([
            "id_gudang" => $this->idGudang,
        ])->orderBy($this->sortField, $this->sort);

        $total = $daftarData->count();

        $daftarData = $daftarData
            ->limit($this->limit)
            ->offset(($this->page - 1) * $this->limit)
            ->get();
        $totalDataPage = $daftarData->count();

        return view("livewire.transaksi.daftar-transaksi-gudang", [
            "daftarData" => $daftarData,
            "totalData" => $total,
            "totalDataPage" => $totalDataPage,
            "idGudang" => $this->idGudang,
        ]);
    }
}
