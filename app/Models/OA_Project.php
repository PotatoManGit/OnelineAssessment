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

    /**
     * @return mixed
     */
    public function GetAllProjectPid()
    {
        return $this->pluck('pid');
    }

    /**
     * @param $pid
     * @return mixed
     */
    public function GetFormulaByPid($pid)
    {
        return $this->where('pid', $pid)->value('formula');
    }

    /**
     * @param $name
     * @param $start_at
     * @param $end_at
     * @param $setting
     * @param $formula
     * @param $process
     * @param $status
     * @return mixed
     */
    public function ProjectCreated($name, $start_at, $end_at, $setting, $formula, $process, $status)
    {
        return $this->insert([
            'name'=>$name,
            'start_at'=>$start_at,
            'end_at'=>$end_at,
            'setting'=>$setting,
            'formula'=>$formula,
            'process'=>$process,
            'update_at'=>time(),
            'status'=>$status
        ]);
    }
}
