<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\OA_User;
use Illuminate\Http\Request;

class UserTypeRegulate extends Controller
{
    /**
     * @param $uid
     * @param $path
     * @return bool
     * 检查是否拥有权限
     */
    function CheckType($uid, $path): bool
    {
        $need = config('kh_privilegeSetting.'.$path);
        $type = str_split((new OA_User())->GetUserType($uid));

        foreach($need as $item)
        {
            if(!in_array($item, $type))
                return false;
        }
        return true;
    }
}
