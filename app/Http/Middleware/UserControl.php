<?php

namespace App\Http\Middleware;

use App\Http\Controllers\System\UserTypeRegulate;
use App\Models\OA_User;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;

/**
 * Class UserControl
 * @package App\Http\Middleware
 * 中间键，用于确保用户有效登录
 */

class UserControl
{

    /**
     * 中间件，登录和权限检测
     * @param Request $request
     * @param Closure $next
     * @return Closure|Application|RedirectResponse|Redirector
     */
    public function handle(Request $request, Closure $next)
    {
        // 获取cookie 验证存在性
        if(empty($_COOKIE['tokenId']) || empty($_COOKIE['token']))
        {
            return redirect('/user/sign_in?cause=1');
        }
        else
        {
            // 解密
            $uid = Crypt::decryptString($_COOKIE['tokenId']);
            $password = Crypt::decryptString($_COOKIE['token']);
        }

        $truePassword = (new OA_User())->GetPasswordByUid($uid);

        if($truePassword == $password)
        {
            $ty = new UserTypeRegulate();
            if($ty->CheckTypeByPath($uid, $request->path()))
            {
                return $next($request);
            }
            else
            {
                echo '<script language="JavaScript">;alert("您的权限不足，无法进入此页面")</script>;';
                return redirect(URL::previous());
            }

        }
        else
        {
            return redirect('/user/sign_in?cause=1');
        }
    }
}
