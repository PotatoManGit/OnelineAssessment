<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OA_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

/**
 * Class SignIn
 * @package App\Http\Controllers\User
 * 用户登录系统
 */

class SignIn extends Controller
{
    public function SignIn(Request $request)
    {
        $check_result = 0;
        if(empty((int)$request['cause']))
        {
            $cause = null;
            // 记住访问登录页面的页面
            $request->session()->put('redirectPath', URL::previous());
        }
        else
        {
            $cause = (int)$request['cause'];
            if($cause == 1)
            {
                $request->session()->put('redirectPath', URL::previous());
            }
        }

        return view('user/signIn', compact('check_result', 'cause'));
    }

    public function SignInCheck(Request $request)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new OA_User();
        $getData = $db->GetUserPassword($username);

        if(!empty($getData->password) && $getData->password == $password)
        {
            $db -> UpdateUserStatus($getData->uid, 1);
            $db -> UpdateLastSignInTime($getData->uid);

            // 加密操作
            $U_uid = Crypt::encryptString($getData->uid);
            $U_password = Crypt::encryptString($getData->password);

            $coTime = time()+config('kh_userSystem.cookieHoldTime_signIn');
            setcookie("tokenId", $U_uid, $coTime, '/');
            setcookie("token", $U_password, $coTime, '/');

            // 跳转之前记住的页面然后删除
            $url = $request->session()->get('redirectPath');
            $request->session()->forget('redirectPath');
            return redirect($url);
        }
        else
        {
            echo '<script language="JavaScript">;alert("'.$_POST['username'].'");
                    location.href="/admin/user_regulate/new_evaluation_user?step=2";</script>;';
            return view('user/signIn', ['check_result'=>1, 'cause'=>0]);
        }
    }
}
