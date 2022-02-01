<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OA_Project extends Model
{
    use HasFactory;

    protected $table = "OA_Project";
    public $timestamps = false;
    protected $primaryKey = 'pid';

    /**
     * @return mixed
     */
    public function GetAll()
    {
        return $this->get();
    }

    /**
     * @param $pid
     * @return mixed
     */
    public function GetDataByPid($pid)
    {
        return $this->where('pid', $pid)->first();
    }

    /**
     * @param $pid
     * @return mixed
     */
    public function GetProcessByPid($pid)
    {
        return $this->where('pid', $pid)->value('process');
    }

    /**
     * @param $pid
     * @return mixed
     */
    public function GetNameByPid($pid)
    {
        return $this->where('pid', $pid)->value('name');
    }
}
