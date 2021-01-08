<?php

namespace App\Http\Livewire\Produk;

use App\Models\Produk;
use App\Models\Satuan;
use Livewire\Component;

class IndexProduk extends Component
{
    // public $daftarUser =[];
    public $page = 1;
    public $limit = 10;
    public $sort = "desc";
    public $sortField = "produk.created_at";
    public $c = "";
    public $searchNamaProduk;
    public $searchNamaSatuan;
    public $searchNamaKategori;
    public $searchHargaModal;

    protected $listeners = ["refreshData"];

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
        $daftarData = Produk::orderBy($this->sortField, $this->sort);
        if ($this->searchNamaProduk != "") {
            $this->page = 1;
            $daftarData->where(
                "nama_produk",
                "like",
                "%" . $this->searchNamaProduk . "%"
            );
        }

        if ($this->searchNamaKategori != "") {
            $this->page = 1;
            $daftarData = $daftarData
                ->join(
                    "kategori",
                    "kategori.id_kategori",
                    "=",
                    "produk.id_kategori"
                )
                ->where(
                    "kategori.nama_kategori",
                    "like",
                    "%" . $this->searchNamaKategori . "%"
                );
        }

        if ($this->searchNamaSatuan != "") {
            $this->page = 1;
            $daftarData = $daftarData
                ->join("satuan", "satuan.id_satuan", "=", "produk.id_satuan")
                ->where(
                    "satuan.nama_satuan",
                    "like",
                    "%" . $this->searchNamaSatuan . "%"
                );
        }

        $total = $daftarData->count();

        $daftarData = $daftarData
            ->limit($this->limit)
            ->offset(($this->page - 1) * $this->limit)
            ->get();
        $totalDataPage = $daftarData->count();

        return view("livewire.produk.index-produk", [
            "daftarData" => $daftarData,
            "totalData" => $total,
            "totalDataPage" => $totalDataPage,
        ]);
    }
}
