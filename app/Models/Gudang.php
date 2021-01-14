<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $guarded = [];

    protected $table = "gudang";
    protected $primaryKey = "id_gudang";
}
