<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = ["nama_kategori"];

    protected $table = "kategori";
    protected $primaryKey = "id_kategori";
}
