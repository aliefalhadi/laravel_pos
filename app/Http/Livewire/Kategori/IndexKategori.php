<?php

namespace App\Http\Livewire\Kategori;

use App\Models\Kategori;
use App\Models\User;
use Livewire\Component;

class IndexKategori extends Component
{
    // public $daftarUser =[];
    public $page = 1;
    public $limit = 10;
    public $sort = "desc";
    public $sortField = "created_at";
    public $c = "";
    public $searchNamaKategori;

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
        $kategori = Kategori::where(["id_kategori" => $idKategori]);

        $kategori->delete();

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil hapus data",
        ]);
    }

    public function render()
    {
        $daftarData = Kategori::orderBy($this->sortField, $this->sort);
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

        return view("livewire.kategori.index-kategori", [
            "daftarData" => $daftarData,
            "totalData" => $total,
            "totalDataPage" => $totalDataPage,
        ]);
    }
}
