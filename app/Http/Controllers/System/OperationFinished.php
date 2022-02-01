<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperationFinished extends Controller
{
    function WorkError(Request $request)
    {
        $data = "";
        $result = '0';
        if(empty($request['cause']))
            $data = '发生了错误，请联系管理员！';
        else
            $data = $request['cause'];

        return view('system.operationFinished', compact('data', 'result'));
    }

    function WorkSuccess(Request $request)
    {
        $data = "";
        $result = '1';
        if(!empty($request['redirect']))
            $result = $request['redirect'];
        if(empty($request['text']))
            $data = '执行成功！';
        else
            $data = $request['text'];

        return view('system.operationFinished', compact('data', 'result'));
    }
}
