<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
 * Class Index
 * @package App\Http\Controllers
 * 首页控制器
 */

class Index extends Controller
{
    public function index()
    {
//        // 获取cookie 验证存在性
//        if(empty($_COOKIE['tokenId']) || empty($_COOKIE['token']))
//        {
//            $signInStatus = 0;
//        }
//        else
//        {
//            // 解密
//            $db = new TT_user();
//            $uid = Crypt::decryptString($_COOKIE['tokenId']);
//            $password = Crypt::decryptString($_COOKIE['token']);
//            $truePassword = $db->CheckCookie($uid);
//            if($password == $truePassword)
//            {
//                $signInStatus = 1;
//            }
//            else
//            {
//                $signInStatus = 0;
//            }
//        }

        return view('index');
//        return redirect('user');
    }
}
