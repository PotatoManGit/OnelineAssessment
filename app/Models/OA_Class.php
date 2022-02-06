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

    /**
     * @param $grade
     * @return mixed
     */
    public function GetAllCidByGrade($grade)
    {
        return $this->where('grade', $grade)->pluck('cid')->all();
    }

    /**
     * @param $cid
     * @return mixed
     */
    public function GetGradeByCid($cid)
    {
        return $this->where('cid', $cid)->value('grade');
    }
}
