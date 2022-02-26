<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\DataProcessing;
use App\Http\Controllers\System\Export;
use App\Http\Controllers\System\ProjectControl;
use App\Models\OA_Class;
use App\Models\OA_Data;
use App\Models\OA_Project;
use App\Models\OA_Tmp;
use App\Models\OA_User;
use Illuminate\Http\Request;

class DataRegulate extends Controller
{
    public function DataRegulate(Request $request)
    {
        if(empty($request['class']))
        {
            return redirect('/work/data_regulate?class=1,2,3');
        }
        else
            return $this->Show($request, 1);
    }

    public function DataView(Request $request)
    {

        if(empty($request['class']))
        {
            return redirect('/work/data_view?class=1,2,3');
        }
        else
            return $this->Show($request, 0);
    }

    public function DataViewCheck()
    {
        $strIn = '';
        if(empty($_POST['class']))
            $need = [1,2,3];
        else
            $need = $_POST['class'];

        if(!in_array(-1, $need))
            foreach($need as $key => $i)
            {
                if($key == 0)
                    $strIn = $i;
                else
                    $strIn = $strIn.','.$i;
            }
        else
            $strIn = '1,2,3';

        if(!empty($_POST['sort']) && $_POST['sort'][0] == 1)
            return redirect('/work/data_view?class='.$strIn.'&sort=1');

        else
            return redirect('/work/data_view?class='.$strIn);

    }

    public function Show($request, $mode)
    {
        $need = explode(',', str_replace(' ', '', $request['class'])); // php 7+
        $needStr = $request['class'];
        if(!($need === false))
        {
            $dbc = new OA_Class();
            $dbp = new OA_Project();
            $dp = new DataProcessing();

            $needCid = array();

            if(!in_array(1, $need) && !in_array(2, $need) && !in_array(3, $need))
                return redirect('/system/work_error?cause=Url错误！发现无效参数！请重试或联系管理员！');

            if($mode == 1)
                $str = ' | 显示数据(数据管理员)：';
            else
                $str = ' | 显示数据：';

            foreach($need as $item)
            {
                $needCid = array_merge($needCid, $dbc->GetAllCidByGrade($item));
                $str .= '高'.$item.'年级 ';
            }


            $data = array();
            $sort = 0;

            if(!empty($request['sort']) && $request['sort'] == 1)
            {
                $tmpData = $dp->SortAllData($dp->AllDataCalculate());
                $str .= ' | 排序:是';
                $sort = 1;
            }

            else
            {
                $tmpData = $dp->AllDataCalculate();
                $str .= ' | 排序:否';
            }


            if($tmpData[0])
                $tmp = $tmpData[1];
            else
                return redirect('/system/work_error?cause='.$tmpData[1]); // 错误处理


            foreach($tmp as $key=>$item)
            {
                if($key != 0)
                    if(in_array($item[0], $needCid))
                        $data[] = $item;
            }

            $head = $tmp[0];

            if(!empty($request['export']) && $request['export'] == 'download')
            {
                if(sizeof($need) == 3)
                    if(!empty($request['sort']) && $request['sort'] == 1)
                        $fileName = '全部年级结果(有序).xlsx';
                    else
                        $fileName = '全部年级结果(无序).xlsx';

                else
                    if(!empty($request['sort']) && $request['sort'] == 1)
                        $fileName = '部分年级结果(有序).xlsx';
                    else
                        $fileName = '部分年级结果(无序).xlsx';

                return (new Export())->DataResultToExcel($tmp, $need, $fileName);
            }

            return view('work.dataView', compact('data', 'mode', 'head', 'str', 'dbc', 'dbp', 'needStr', 'sort'));
        }
        else
        {
            return redirect('/system/work_error?cause=Url错误！发现无效参数！请重试或联系管理员！');
        }
    }

    public function DataRegulateCheck()
    {
        $strIn = '';
        if(empty($_POST['class']))
            $need = [1,2,3];
        else
            $need = $_POST['class'];

        if(!in_array(-1, $need))
            foreach($need as $key => $i)
            {
                if($key == 0)
                    $strIn = $i;
                else
                    $strIn = $strIn.','.$i;
            }
        else
            $strIn = '1,2,3';

        if(!empty($_POST['sort']) && $_POST['sort'][0] == 1)
            return redirect('/work/data_regulate?class='.$strIn.'&sort=1');

        else
            return redirect('/work/data_regulate?class='.$strIn);
    }

    public function DataRegulateEditCheck(Request $request)
    {
        if(empty($request['cid']))
        {
            return redirect('/system/work_error?cause=Url错误！参数不全！请重试或联系管理员！');
        }
        elseif(!empty($request['cmd']) && !empty($request['did']))
        {
            if($request['cmd'] == 'del')
            {
                (new OA_Data())->DelDataByDid((int)$request['did']);
                return redirect('/system/work_success?text=已删除&redirect=work/data_regulate');
            }

            elseif($request['cmd'] == 'again')
            {
                (new OA_Tmp())->AddOneByData((new OA_Data())->GetByDid((int)$request['did']), 4);
                (new OA_Data())->DelDataByDid((int)$request['did']);
                return redirect('/system/work_success?text=已退回重审&redirect=work/data_regulate');
            }
            else
                return redirect('/system/work_error?cause=Url错误！参数错误！请重试或联系管理员！');
        }
        else
        {
            $dbu = new OA_user();
//        $dbu->GetUsernameByUid();
            $dbc = new OA_Class();
//        $dbc->GetNameByCid();
            $dbp = new OA_Project();
//        $dbp->GetNameByPid();

            $data = (new OA_Data())->ListAll();

            $tmpData = (new DataProcessing())->FormattingDataToString($data);

            if(is_numeric($request['cid']))
                $cid = (int)$request['cid'];
            else
                return redirect('/system/work_error?cause=编辑失败！推测为班级cid错误，请重试或联系管理员！');

            return view('work.dataEdit', compact('data', 'tmpData', 'dbp', 'dbu', 'dbc', 'cid'));
        }
    }
}
