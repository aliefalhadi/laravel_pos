<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGudang extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = "stok_gudang";
    protected $primaryKey = "id_stok_gudang";

    public function produk()
    {
        return $this->belongsTo("App\Models\Produk", "id_produk");
    }

    public function getStatusStokAttribute()
    {
        if ($this->stok == 0) {
            return "Kosong";
        }
        if ($this->stok > $this->min_stok) {
            return "Ready";
        } else {
            return "Hampir Habis";
        }
    }
}
