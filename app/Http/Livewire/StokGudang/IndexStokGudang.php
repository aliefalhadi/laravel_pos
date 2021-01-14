<?php

namespace App\Http\Livewire\StokGudang;

use App\Models\Kategori;
use App\Models\StokGudang;
use App\Models\User;
use Livewire\Component;

class IndexStokGudang extends Component
{
    // public $daftarUser =[];
    public $page = 1;
    public $limit = 25;
    public $sort = "desc";
    public $sortField = "updated_at";
    public $c = "";
    public $searchNamaKategori;
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

    public function deleteData($idKategori)
    {
        $kategori = Kategori::where(["id_kategori" => $idKategori]);

        $kategori->delete();

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil hapus data",
        ]);
    }

    public function render()
    {
        $daftarData = StokGudang::where([
            "id_gudang" => $this->idGudang,
        ])->orderBy($this->sortField, $this->sort);
        if ($this->searchNamaKategori != "") {
            $this->page = 1;
            $daftarData->where(
                "nama_kategori",
                "like",
                "%" . $this->searchNamaKategori . "%"
            );
        }

        $total = $daftarData->count();

        $daftarData = $daftarData
            ->limit($this->limit)
            ->offset(($this->page - 1) * $this->limit)
            ->get();
        $totalDataPage = $daftarData->count();

        return view("livewire.stok-gudang.index-stok-gudang", [
            "daftarData" => $daftarData,
            "totalData" => $total,
            "totalDataPage" => $totalDataPage,
        ]);
    }
}
