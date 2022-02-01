<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\ProjectControl;
use App\Models\OA_Class;
use App\Models\OA_Data;
use App\Models\OA_Project;
use App\Models\OA_Tmp;
use App\Models\OA_User;
use Illuminate\Http\Request;

class Audit extends Controller
{
    public function Audit()
    {
        $dbu = new OA_user();
//        $dbu->GetUsernameByUid();
        $dbc = new OA_Class();
//        $dbc->GetNameByCid();
        $dbp = new OA_Project();
//        $dbp->GetNameByPid();

        $data = (new OA_Tmp())->ListAll();

        $tmpData = array();
        foreach($data as $val)
        {
            $text = "";
            foreach($val['data']['data'] as $key=>$item)
            {
                $tmp = '';
                if($key != 0)
                {
                    if($item['type'] == 'bool')
                    {
                        if($item['data'] == 1)
                            $tmp = $item['name'] . ': 是';
                        else
                            $tmp = $item['name'] . ': 否';
                    }
                    else
                        $tmp = $item['name'] . ': ' . $item['data'];
                }
                $text .= $tmp.'\n';
            }
            $tmpData[] = $text;
        }

        return view('work.audit', compact('data', 'tmpData', 'dbp', 'dbu', 'dbc'));
    }

    public function AuditCheck(Request $request)
    {
        if(empty($request['tid']) || empty($request['status']))
        {
            return redirect('/system/work_error?cause=操作失败！参数缺失！请退回重试或联系管理员！');
        }
        else
        {
            if($request['status'] == 1)
                (new OA_Data())->AddOneByTmp((new OA_Tmp())->GetByTid((int)$request['tid']));
            elseif($request['status'] == 2)
                (new OA_Tmp())->ChangeStatusByTid((int)$request['tid']);
            elseif($request['status'] == 3)
                (new OA_Tmp())->DelByTid((int)$request['tid']);

            return redirect('/system/work_success?text=操作成功');
        }
    }
}
