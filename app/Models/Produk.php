<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $guarded = [];

    protected $table = "produk";
    protected $primaryKey = "id_produk";

    public function satuan()
    {
        return $this->belongsTo("App\Models\Satuan", "id_satuan");
    }

    public function kategori()
    {
        return $this->belongsTo("App\Models\Kategori", "id_kategori");
    }

    public function getHargaModalRupiahAttribute()
    {
        return "Rp " . number_format($this->harga_modal, 2, ",", ".");
    }

    public function getHargaJualRupiahAttribute()
    {
        return "Rp " . number_format($this->harga_jual, 2, ",", ".");
    }
}
