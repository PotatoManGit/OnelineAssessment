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
    private OA_Project $dbt;

    public function __construct()
    {
        $this->dbt = new OA_Project();
    }

    /**
     * @return array
     */
    public function GetAll(): array
    {
        $data = $this->dbt->GetAll();
        $result = array();
        foreach($data as $val)
        {
            $js = json_decode($val->setting, true);
            $result[] = ['name'=>$val->name,
                'start_at'=>$val->start_at,
                'end_ar'=>$val->end_at,
                'setting'=>$js,
                'process'=>$val->process,
                'priority'=>$val->priority,
                'update_at'=>$val->update_at,
                'status'=>$val->status];
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
            $result[] = ['name'=>$val['name'],
                'start_at'=>$val['start_at'],
                'end_at'=>$val['end_at'],
                'status'=>$val['status']];
        }
        return $result;
    }
}
