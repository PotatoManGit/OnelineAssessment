<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\OA_Data;
use App\Models\OA_Tmp;
use Illuminate\Http\Request;

class DataControl extends Controller
{
    public function PushData($pid, $uid, $cid, $data, $up=false, $did=0): string
    {

        $pro = (new ProjectControl())->GetProcessByPid($pid);
        $utr = new UserTypeRegulate();

        if($up)
            $pro = 4;

        if($pro == 1 && $utr->CheckTypeByCode($uid, 3))
        {
            $db = new OA_Tmp();
            if($db->CheckEmptyByCid($cid))
            {
                $db->AddOne($pid, $uid, $cid, $data, 1);
                return '/system/work_success?text=上传成功&redirect=/work/data_entry';
            }
            else
                return '/system/work_error?cause=上传失败！该数据重复上传！请咨询数据管理员！';
        }
        elseif($pro == 2 && $utr->CheckTypeByCode($uid, 3))
        {
            $db = new OA_Data();
            if($db->CheckEmptyByCid($cid))
            {
                $db->AddOne($pid, $uid, $cid, $data);
                return '/system/work_success?text=上传成功&redirect=/work/data_entry';
            }
            else
                return '/system/work_error?cause=上传失败！该数据重复上传！请咨询管理员！';
        }
        elseif($pro == 3 && $utr->CheckTypeByCode($uid, 5))
        {
            $db = new OA_Data();
            if($db->CheckEmptyByCid($cid))
            {
                if($db->AddOne($pid, $uid, $cid, $data))
                    return '/system/work_success?text=上传成功&redirect=/work/data_entry';
                else
                    return '/system/work_error?cause=提交失败，数据库错误，请重试或请联系管理员!';
            }
            else
                return '/system/work_error?cause=上传失败！该数据重复上传！请咨询管理员！';
        }
        elseif($pro == 4 && $did != 0 && $utr->CheckTypeByCode($uid, 5))
        {
            $db = new OA_Data();

            if($db->UpdateOneByDid($did, $pid, $uid, $cid, $data))
                return '/system/work_success?text=上传成功&redirect=/work/data_regulate';
            else
                return '/system/work_error?cause=提交失败，数据库错误，请重试或请联系管理员!';
        }
        else
            return '/system/work_error?cause=提交失败，原因推测为您的权限不足或项目设定错误!';
    }
}
