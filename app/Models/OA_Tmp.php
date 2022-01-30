<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OA_Tmp extends Model
{
    use HasFactory;

    protected $table = "OA_Tmp";
    public $timestamps = false;
    protected $primaryKey = 'tid';
}
