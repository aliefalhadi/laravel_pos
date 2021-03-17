<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Livewire\Component;

class DetailTransaksi extends Component
{
    public $dataTransaksi;
    public $dataTransaksiDetail;
    public $idTransaksi;

    public function mount($idTransaksi){
        $this->idTransaksi = $idTransaksi;
    }

    public function render()
    {
        $this->dataTransaksi = Transaksi::where(['id_transaksi'=>$this->idTransaksi])->first();
        $this->dataTransaksiDetail = TransaksiDetail::where(['id_transaksi'=>$this->idTransaksi])->get();
        return view('livewire.transaksi.detail-transaksi');
    }
}
