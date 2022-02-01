<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\OA_Project;
use Illuminate\Http\Request;

class ProjectControl extends Controller
{
    /**
     * @var OA_Project
     */
    private OA_Project $dbp;

    public function __construct()
    {
        $this->dbp = new OA_Project();
    }

    /**
     * @return array
     */
    public function GetAll(): array
    {
        $data = $this->dbp->GetAll();
        $result = array();
        foreach($data as $val)
        {
            $js = json_decode($val->setting, true);
            $result[] = [
                'pid'=>$val->pid,
                'name'=>$val->name,
                'start_at'=>$val->start_at,
                'end_at'=>$val->end_at,
                'setting'=>$js,
                'formula'=>$val->formula,
                'process'=>$val->process,
                'update_at'=>$val->update_at,
                'status'=>$val->status
            ];
        }
        return $result;
    }

    /**
     * @return array
     */
    public function ListAll(): array
    {
        $data = $this->GetAll();
        $result = array();
        foreach($data as $val)
        {
            $result[] = [
                'pid'=>$val['pid'],
                'name'=>$val['name'],
                'start_at'=>$val['start_at'],
                'end_at'=>$val['end_at'],
                'process'=>$val['process'],
                'note'=>$val['setting']['note'],
                'status'=>$val['status']
            ];
        }
        return $result;
    }

    /**
     * @param $pid
     * @return array
     */
    public function GetOneForInput($pid): array
    {
        $data = $this->dbp->GetDataByPid($pid);
        $js = json_decode($data->setting, true);
        return [
            'name'=>$data->name,
            'num'=>$js['num'],
            'note'=>$js['note'],
            'setting'=>$js['setting'],
        ];
    }

    /**
     * @param $pid
     * @param $key
     * @return mixed
     */
    public function GetSettingByKey($pid, $key)
    {
        $data = $this->dbp->GetDataByPid($pid);
        $js = json_decode($data->setting, true);
        return $js['setting'][$key];
    }

    public function GetProcessByPid($pid)
    {
        return $this->dbp->GetProcessByPid($pid);
    }
}
