<?php

namespace App\Http\Livewire\Gudang;

use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\User;
use Livewire\Component;

class IndexGudang extends Component
{
    // public $daftarUser =[];
    public $page = 1;
    public $limit = 10;
    public $sort = "desc";
    public $sortField = "created_at";
    public $c = "";
    public $searchNamaGudang;

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

    public function deleteData($idKategori)
    {
        $kategori = Gudang::where(["id_gudang" => $idKategori]);

        $kategori->delete();

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil hapus data",
        ]);
    }

    public function render()
    {
        $daftarData = Gudang::orderBy($this->sortField, $this->sort);
        if ($this->searchNamaGudang != "") {
            $this->page = 1;
            $daftarData->where(
                "nama_gudang",
                "like",
                "%" . $this->searchNamaGudang . "%"
            );
        }

        $total = $daftarData->count();

        $daftarData = $daftarData
            ->limit($this->limit)
            ->offset(($this->page - 1) * $this->limit)
            ->get();
        $totalDataPage = $daftarData->count();

        return view("livewire.gudang.index-gudang", [
            "daftarData" => $daftarData,
            "totalData" => $total,
            "totalDataPage" => $totalDataPage,
        ]);
    }
}
