<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OA_Data extends Model
{
    use HasFactory;

    protected $table = "OA_Data";
    public $timestamps = false;
    protected $primaryKey = 'did';

    /**
     * @param $pid
     * @param $uid
     * @param $data
     * @param $status
     * @return bool
     */
    public function AddOne($pid, $uid, $cid, $data, $status): bool
    {
        $this->insert([
            'pid'=>$pid,
            'uid'=>$uid,
            'cid'=>$cid,
            'data'=>$data,
            'update_at'=>time(),
            'status'=>$status
        ]);
        return 1;
    }

    /**
     * @param $cid
     * @return bool
     */
    public function CheckEmptyByCid($cid): bool
    {
        if($this->where('cid', $cid)->value('cid') == null)
            return true;
        else
            return false;
    }

    /**
     * @param $OA_Tmp
     * @return mixed
     */
    public function AddOneByTmp($OA_Tmp)
    {

        return $this->insert([
            'pid' => $OA_Tmp->pid,
            'uid' => $OA_Tmp->uid,
            'cid' => $OA_Tmp->cid,
            'data' => $OA_Tmp->data,
            'update_at' => time()
        ]);
    }

    /**
     * @param $pid
     * @param $cid
     * @return mixed
     */
    public function GetOneByPidCid($pid, $cid)
    {
        return $this->where('cid', $cid)->where('pid', $pid)->first();
    }
}
