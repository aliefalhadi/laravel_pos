<?php

namespace App\Http\Livewire\Satuan;

use App\Models\Satuan;
use Livewire\Component;

class IndexSatuan extends Component
{
    // public $daftarUser =[];
    public $page = 1;
    public $limit = 10;
    public $sort = "desc";
    public $sortField = "created_at";
    public $c = "";
    public $searchNamaSatuan;

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
        $kategori = Satuan::where(["id_satuan" => $id]);

        $kategori->delete();

        $this->dispatchBrowserEvent("alert", [
            "type" => "success",
            "message" => "Berhasil hapus data",
        ]);
    }

    public function render()
    {
        $daftarData = Satuan::orderBy($this->sortField, $this->sort);
        if ($this->searchNamaSatuan != "") {
            $this->page = 1;
            $daftarData->where(
                "nama_satuan",
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

        return view("livewire.satuan.index-satuan", [
            "daftarData" => $daftarData,
            "totalData" => $total,
            "totalDataPage" => $totalDataPage,
        ]);
    }
}
