<?php

namespace App\Http\Controllers\System;

use App\Exports\DataResultExport\DataResultExport;
//use App\Exports\UserListToExcel\UserListToExcel;
use App\Http\Controllers\Controller;
use App\Models\OA_Class;
use App\Models\OA_Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use function Symfony\Component\Translation\t;

class Export extends Controller
{
    /**
     * @param $data
     * @param $need
     * @param $fileName
     * @return BinaryFileResponse
     * 格式化并导出为excel
     */
    public function DataResultToExcel($data, $need, $fileName): BinaryFileResponse
    {
        $re = Array();
        $dbc = new OA_Class();

        foreach($data[0] as $key=>$item)
        {
            if($item == 'cid')
                $data[0][$key] = '支部';
            elseif($item == 'sm')
                $data[0][$key] = '总分';
            else
                $data[0][$key] = (new OA_Project())->GetNameByPid($item);
        }

        $head = $data[0];
        unset($data[0]);

        foreach($need as $item)
        {
            $tmp = array();
            $tmp[] = $head;
            foreach($data as $val)
            {
                $grade = $dbc->GetGradeByCid($val[0]);
                if($item == $grade)
                {
                    $val[0] = $dbc->GetNameByCid($val[0]);
                    $tmp[] = $val;
                }

            }
            $re[] = $tmp;

        }


        $export = new DataResultExport($re, $need);
        return Excel::download($export, $fileName);
    }

//    /**
//     * @param $grade
//     * @param $data
//     * @return Application|Factory|View|BinaryFileResponse
//     */
//    public function UserListToExcel($grade, $data)
//    {
//        if($grade == 1)
//            $fileName = '高一.xlsx';
//        elseif($grade == 2)
//            $fileName = '高二.xlsx';
//        elseif($grade == 3)
//            $fileName = '高三.xlsx';
//        else
//            return view('admin/operationFinished', ['result'=>0]);
//
//        $re = Array(Array());
//        foreach($data as $key=>$val)
//        {
//            $tmp = (int)str_replace('u', '', $val[0]);
//            if($tmp > ($grade * 100000) && $tmp < ($grade * 100000 + 100000))
//            {
//                $tmp -= $grade * 100000;
//                $tmp = intval($tmp/100);
//                $re[$tmp-1][] = $val;
//            }
//        }
////        $re = Array([1,2],[2,3],[4,5]);
//        $export = new UserListToExcel($re);
//        return Excel::download($export, $fileName);
//    }
}
