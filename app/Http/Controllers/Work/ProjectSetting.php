<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Models\OA_Class;
use Illuminate\Http\Request;

class ProjectSetting extends Controller
{
    public function ProjectSetting()
    {
        return view('work.projectSetting');
    }

    public function ProjectEdit()
    {
        return view('work.projectEdit');
    }

    public function ProjectCheck(Request $request)
    {
        if(!empty($request['status']) && $request['status'] == 'ok')
        {
            $str = '';
            !empty($_COOKIE['P_name']) ? $P_name = $_COOKIE['P_name'] : $P_name = '项目名未设置！';
            !empty($_COOKIE['P_process']) ? $P_process = $_COOKIE['P_process'] : $P_process = '1';
            !empty($_COOKIE['P_kh_class']) ? $P_kh_class = $_COOKIE['P_kh_class'] : $P_kh_class = '1,2,3';
            !empty($_COOKIE['P_start_at']) ? $P_P_start_at = $_COOKIE['P_start_at'] : $P_P_start_at = '1970-01-01 00:00:00';
            !empty($_COOKIE['P_end_at']) ? $P_end_at = $_COOKIE['P_end_at'] : $P_end_at = '1970-01-01 00:00:00';

            $num = 0;
            $tmpStr = '';
            for($i = 1; true; $i++)
            {
                if(!empty($_COOKIE['P_dataName_'.$i]) && !empty($_COOKIE['P_dataType_'.$i]))
                {
                    $tmpStr .= ',';
                    $tmp = sprintf('{"name":"%s", "type":"%s"}', $_COOKIE['P_dataName_'.$i], $_COOKIE['P_dataType_'.$i]);
                    $num = $i;
                    $tmpStr .= $tmp;
                }
                else
                    break;
            }

            $cid = '';
            foreach (explode(',', $P_kh_class) as $key=>$item)
            {
                if($key >= 1)
                    $cid .= ',';

                $cid .= implode(',', (new OA_Class())->GetAllCidByGrade($item)) ;
            }

            $str = sprintf('{"num":%s, "note":"正常","setting":[{"name":"请选择录入的支部","type": "list","item":[%s]}%s]}'
                , ($num+1), $cid, $tmpStr);

            return $str;

        }
        else
//        return redirect('/system/work_success?text=上传成功&redirect=/work/project_setting');
            return redirect('/system/work_error?cause=上传失败');
//        return view('work.projectEdit');
    }
}
