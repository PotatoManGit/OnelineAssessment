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
     * @return int
     */
    public function AddOneByTmp($OA_Tmp): int
    {
        $this->insert($OA_Tmp);
        return 1;
    }
}
