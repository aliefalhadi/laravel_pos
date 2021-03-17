<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $guarded = [];

    protected $table = "transaksi_detail";
    protected $primaryKey = "id_transaksi_detail";

    public function produk()
    {
        return $this->belongsTo("App\Models\Produk", "id_produk");
    }
}
