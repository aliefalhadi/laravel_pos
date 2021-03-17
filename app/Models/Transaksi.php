<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $guarded = [];
    

    protected $table = "transaksi";
    protected $primaryKey = "id_transaksi";
    public $incrementing = false;

    public function gudang()
    {
        return $this->belongsTo("App\Models\Gudang", "id_gudang", "id_gudang");
    }

    public function kasir()
    {
        return $this->belongsTo("App\Models\User", "id_kasir","id");
    }
}
