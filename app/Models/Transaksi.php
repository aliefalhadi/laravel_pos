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
}
