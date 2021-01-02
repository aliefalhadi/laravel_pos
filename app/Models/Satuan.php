<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    const UPDATED_AT = null;

    protected $guarded = [];

    protected $table = "satuan";
    protected $primaryKey = "id_satuan";
}
