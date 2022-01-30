<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OA_User extends Model
{
    use HasFactory;

    protected $table = "OA_User";
    public $timestamps = false;
    protected $primaryKey = 'uid';

    /**
     * @param $username
     * @return mixed
     */
    public function GetUserPassword($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * @param $uid
     * @param $newUserStatus
     * @return mixed
     */
    public function UpdateUserStatus($uid, $newUserStatus)
    {
        return $this->where('uid', $uid)
            ->update(['status' => $newUserStatus]);
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function UpdateLastSignInTime($uid)
    {
        $time = time();
        return $this->where('uid', $uid)
            ->update(['update_at' => $time]);
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function UpdateFinishTime($uid)
    {
        $time = time();
        return $this->where('uid', $uid)
            ->update(['finish_time' => $time]);
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function GetUserStatus($uid)
    {
        return $this->where('uid', $uid)->value('status');
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function GetPasswordByUid($uid)
    {
        return $this->where('uid', $uid)->value('password');
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function GetUserType($uid)
    {
        return $this->where('uid', $uid)->value('type');
    }

//    /**
//     *
//     */
//    public function DelAllUserWithoutAdmin()
//    {
//        $admin = $this->where('type', 777)->get();
//        $this->truncate();
//        foreach($admin as $ad)
//        {
//            $this->insert(['username'=>$ad->username,
//                'password'=>$ad->password,
//                'type'=>777,
//                'update_at'=>$ad->last_sign_in]);
//        }
//    }

//    /**
//     * @param $UserList
//     */
//    public function PushNewUserList($UserList)
//    {
//        foreach($UserList as $user)
//        {
//            $this->insert(['username'=>$user[0],
//                'password'=>$user[1]]);
//        }
//    }

    /**
     * @param $uid
     */
    public function DelUser($uid)
    {
        $this->where('uid', $uid)->delete();
    }

//    /**
//     * @return mixed
//     */
//    public function GetAdmin()
//    {
//        return $this->where('type', 777)->get();
//    }

//    /**
//     * @param $username
//     * @param $password
//     * @param $type
//     * @param $do
//     * @return bool
//     */
//    public function AddUser($username, $password, $type, $do):bool
//    {
//        $tmp = $this->where('username', $username)->first();
//        if($tmp != null && $do == 1)
//        {
//            return 0;
//        }
//        elseif($do == 2)
//        {
//            $this->where('username', $username)->update(['password'=>$password, 'type'=>$type]);
//            return 1;
//        }
//        else
//        {
//            $this->insert(['username'=>$username, 'password'=>$password, 'type'=>$type]);
//            return 1;
//        }
//    }

    /**
     * @param $num
     * @return mixed
     */
    public function GetAllDataToPaging($num)
    {
        return $this->paginate($num);
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function GetUsernameByUid($uid)
    {
        return $this->where('uid', $uid)->value('username');
    }
}
