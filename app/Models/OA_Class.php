<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OA_Class extends Model
{
    use HasFactory;

    protected $table = "OA_Class";
    public $timestamps = false;
    protected $primaryKey = 'cid';

    /**
     * @param $cid
     * @return mixed
     */
    public function GetNameByCid($cid)
    {
        return $this->where('cid',$cid)->value('name');
    }

    /**
     * @return mixed
     */
    public function GetAllClassCid()
    {
        return $this->pluck('cid');
    }
}
