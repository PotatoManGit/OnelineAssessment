<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Control;
use Illuminate\Http\Request;

/**
 * Class AdminControl
 * @package App\Http\Controllers\admin
 * 管理员控制系统，url命令
 */
class AdminControl extends Controller
{
    public function AdminControl(Request $request)
    {
        $func = new Control();
        if(empty($request['cmd']))
        {
            $result = 0;
        }

        elseif($request['cmd'] == 'evaluationStatus' && !empty($request['val-1']))
        {
            $result = $func->evaluationStatus($request['val-1']);
        }

        elseif($request['cmd'] == 'makeNewUserListAndPush' &&
            !empty($request['val-1']) &&
            !empty($request['val-2']) &&
            !empty($request['val-3']) &&
            !empty($request['val-4']) &&
            !empty($request['val-5']) &&
            !empty($request['val-6']))
        {
            $func->pushEvaluationUser($func->newEvaluationUser((int)$request['val-1'],
                (int)$request['val-2'],
                (int)$request['val-3'],
                (int)$request['val-4'],
                (int)$request['val-5'],
                (int)$request['val-6']));
            $result = 1;
        }

        elseif($request['cmd'] == 'del_user' && !empty($request['val-1']))
        {
            $result = $func->delUser((int)$request['val-1']);
        }

        elseif($request['cmd'] == 'delAllEvaluationData')
        {
            $func->delAllEvaluationData();
            $result = 1;
        }

        elseif($request['cmd'] == 'delEvaluationDataById' && !empty($request['val-1']))
        {
            $result = $func->delEvaluationDataById((int)$request['val-1']);
        }

        else
            $result = 0;

        return view('admin/operationFinished', compact('result'));
    }
}
