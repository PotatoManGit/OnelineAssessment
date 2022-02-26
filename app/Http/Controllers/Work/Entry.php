<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\DataControl;
use App\Http\Controllers\System\ProjectControl;
use App\Models\OA_Class;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Entry extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function Entry()
    {
        $data = (new ProjectControl())->ListAll();
        return view('work.entry', compact('data'));
    }

    public function EntryInput(Request $request)
    {
        if(empty($request['pid']))
        {
            echo '<script language="JavaScript">;alert("请先选择一项审核项目")</script>;';
            return redirect('/data_entry');
        }

        $edit = false;
        $cid = 0;
        $did = 0;
        if(!empty($request['type']) && !empty($request['cid']) && $request['type'] == 'edit' && !empty($request['did']))
        {
            $edit = true;
            if(is_numeric($request['cid']) && is_numeric($request['did']))
            {
                $cid = (int)$request['cid'];
                $did = (int)$request['did'];
            }
            else
                return redirect('/system/work_error?cause=编辑失败！推测为班级cid或数据did错误，请重试或联系管理员！');
        }


        $pid = $request['pid'];
        $data = (new ProjectControl())->GetOneForInput((int)$pid);
        $dbc = new OA_Class();

        $pc = new ProjectControl();
        $index = $pc->GetOneForInput($pid)['setting'][0]['item'];

        return view('work.entryInput', compact('data', 'pid', 'dbc', 'edit', 'cid', 'index', 'did'));
    }

    public function EntryInputCheck(Request $request)
    {
        $pc = new ProjectControl();
        $pid = (int)$request['pid'];
        $uid = Crypt::decryptString($_COOKIE['tokenId']);
        $index = $pc->GetOneForInput($pid)['setting'];

        $cid = $index[0]['item'][$_POST[0]];

        $data = '{"data":[';
        foreach($index as $key=>$val)
        {
            $se = $pc->GetSettingByKey($pid, $key);
            if($se['type'] == 'list')
                $tmp = '{"name":"'.$se['name'].'","type":"list","data":"'.$se['item'][$_POST[$key]].'"}';
            elseif($se['type'] == 'num')
                $tmp = '{"name":"'.$se['name'].'","type":"num","data":"'.$_POST[$key].'"}';
            elseif($se['type'] == 'text')
                $tmp = '{"name":"'.$se['name'].'","type":"text","data":"'.$_POST[$key].'"}';
            elseif($se['type'] == 'bool')
                $tmp = '{"name":"'.$se['name'].'","type":"bool","data":"'.$_POST[$key].'"}';
            else
                return redirect('/system/work_error?cause=发现不存在的项目数据类型，推测为项目设置错误或系统错误，请联系管理员！');

            if($key == 0)
                $data .= $tmp;
            else
                $data .= ','.$tmp;
        }
        $data .= ']}';

        if(!empty($_POST['edit']) && !empty($_POST['did']))
        {
            return redirect((new DataControl())->PushData($pid, $uid, $cid, $data, true, $_POST['did']));
        }

        return redirect((new DataControl())->PushData($pid, $uid, $cid, $data));
    }
}
