<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OA_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
            $cause = null;

        else
            $cause = (int)$request['cause'];

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

            return redirect('/');
        }
        else
        {
            return view('user/signIn', ['check_result'=>1, 'cause'=>0]);
        }
    }
}
