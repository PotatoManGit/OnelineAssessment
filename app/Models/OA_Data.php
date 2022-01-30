<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OA_Data extends Model
{
    use HasFactory;

    protected $table = "OA_Data";
    public $timestamps = false;
    protected $primaryKey = 'id';
}
