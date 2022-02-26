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
     * @param $cid
     * @param $data
     * @return bool
     */
    public function AddOne($pid, $uid, $cid, $data): bool
    {
        return $this->insert([
            'pid' => $pid,
            'uid' => $uid,
            'cid' => $cid,
            'data' => $data,
            'update_at' => time()
        ]);
    }

    /**
     * @param $did
     * @param $pid
     * @param $uid
     * @param $cid
     * @param $data
     * @return mixed
     */
    public function UpdateOneByDid($did, $pid, $uid, $cid, $data)
    {
        return $this->where('did', $did)->update([
            'pid' => $pid,
            'uid' => $uid,
            'cid' => $cid,
            'data' => $data,
            'update_at' => time()
        ]);
    }

    /**
     * @param $cid
     * @return bool
     */
    public function CheckEmptyByCid($cid): bool
    {
        if ($this->where('cid', $cid)->value('cid') == null)
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
            'update_at' => $OA_Tmp->update_at
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

    /**
     * @param $did
     * @return mixed
     */
    public function DelDataByDid($did)
    {
        return $this->where('did', $did)->delete();
    }

    /**
     * @param $did
     * @return mixed
     */
    public function GetByDid($did)
    {
        return $this->where('did', $did)->first();
    }

    /**
     * @return array
     */
    public function ListAll(): array
    {
        $data = $this->get();
        $result = array();
        foreach ($data as $val) {
            $js = json_decode($val->data, true);
            $result[] = [
                'did' => $val->did,
                'pid' => $val->pid,
                'uid' => $val->uid,
                'cid' => $val->cid,
                'data' => $js,
                'update_at' => $val->update_at
            ];
        }
        return $result;
    }
}
