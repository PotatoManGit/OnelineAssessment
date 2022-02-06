<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\OA_Class;
use App\Models\OA_Data;
use App\Models\OA_Project;
use App\Models\OA_User;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class DataProcessing extends Controller
{
    /**
     * @param $data
     * @return array
     * 将数据库查询结果中的数据格式化为字符串
     */
    public function FormattingDataToString($data): array
    {
        $tmpData = array();
        foreach($data as $val)
        {
            $text = "";
            foreach($val['data']['data'] as $key=>$item)
            {
                $tmp = '';
                if($key != 0)
                {
                    if($item['type'] == 'bool')
                    {
                        if($item['data'] == 1)
                            $tmp = $item['name'] . ': 是';
                        else
                            $tmp = $item['name'] . ': 否';
                    }
                    else
                        $tmp = $item['name'] . ': ' . $item['data'];
                }
                $text .= $tmp.'\n';
            }
            $tmpData[] = $text;
        }
        return $tmpData;
    }

    /**
     * 字符串公式计算，别人的
     * @return mixed|null|string|string[]
     */
    function bc()
    {
        bcscale(3);
        $argv = func_get_args();
        $string = str_replace(' ', '', '(' . $argv[0] . ')');
        $string = preg_replace_callback('/\$([0-9\.]+)/', function ($matches) {
            return '$argv[$1]';
        }, $string);

        while (preg_match('/(()?)\(([^\)\(]*)\)/', $string, $match)) {

            while (preg_match('/([0-9\.]+)(\^)([0-9\.]+)/', $match[3], $m) || preg_match('/([0-9\.]+)([\*\/\%])([0-9\.]+)/', $match[3], $m) || preg_match('/([0-9\.]+)([\+\-])([0-9\.]+)/', $match[3], $m)) {

                switch ($m[2]) {
                    case '+':
                        $result = bcadd($m[1], $m[3]);
                        break;
                    case '-':
                        $result = bcsub($m[1], $m[3]);
                        break;
                    case '*':
                        $result = bcmul($m[1], $m[3]);
                        break;
                    case '/':
                        $result = bcdiv($m[1], $m[3]);
                        break;
                    case '%':
                        $result = bcmod($m[1], $m[3]);
                        break;
                    case '^':
                        $result = bcpow($m[1], $m[3]);
                        break;
                }

                $match[3] = str_replace($m[0], $result, $match[3]);
            }
            if (!empty($match[1]) && function_exists($func = 'bc' . $match[1])) {
                $match[3] = $func($match[3]);
            }
            $string = str_replace($match[0], $match[3], $string);
        }
        return $string;
    }

    /**
     * @param $data
     * @param $formula
     * @return array
     */
    public function ProjectDataCalculate($data, $formula): array
    {
        $fma = explode(',', $formula);
        $str = '';
        foreach($fma as $val)
        {
            if(is_numeric($val))
            {
                if($data[$val]['type'] == 'text' || $data[$val]['type'] == 'list')
                    return [0, '运算错误！检测到无法计算数据类型！推测为考核项目设置错误！请修改或联系管理员！'];
                else
                    $tmp = $data[$val]['data'];
            }
            else
                $tmp = $val;

            $str .= $tmp;
        }

        ($str);

        return [1,$this->bc($str)];
    }

    /**
     * @return array
     */
    public function AllDataCalculate(): array
    {
        $dbc = new OA_Class();
        $dbp = new OA_Project();
        $dbd = new OA_Data();

        $aPid = $dbp->GetAllProjectPid();
        $aCid = $dbc->GetAllClassCid();
        $result = array();

        $tp = array();
        $tp[] = 'cid';
        foreach($aPid as $i=>$pid)
        {
            $tp[] = $pid;
        }
        $tp[] = 'sm';
        $result[] = $tp;

        foreach($aCid as $key=>$cid)
        {
            $tmp = array();
            $tmp[] = $cid;
            $sm = 0.0;

            foreach($aPid as $i=>$pid)
            {

                $dr = $dbd->GetOneByPidCid($pid, $cid);

                if(empty($dr))
                    $pCou = 0.0;
                else
                {
//                    var_dump(json_decode($dr->data, true)['data']);
                    $pCou = $this->ProjectDataCalculate(json_decode($dr->data, true)['data'],
                        $dbp->GetFormulaByPid($pid));
                    if($pCou[0])
                        $pCou = (int)$pCou[1];
                    else
                        return [0, $pCou[1]];
                }
                $sm += $pCou;
                $tmp[] = $pCou;
            }
            $tmp[] = $sm;
            $result[] = $tmp;
        }
        return [1, $result];
    }

    /**
     *
     * 二维数组按指定列排序，别人家的孩子 参数一次为：待排序数组，排序列索引，升序降序-默认降序
     * @param $arr_data
     * @param $field
     * @param $descending
     * @return array 排序好的数组
     **/
    function ARRAY_sort_by_field($arr_data, $field, $descending = false): array
    {
        $arrSort = array();
        foreach ( $arr_data as $key => $value ) {
            $arrSort[$key] = $value[$field];
        }

        if( $descending ) {
            arsort($arrSort);
        } else {
            asort($arrSort);
        }

        $resultArr = array();
        foreach ($arrSort as $key => $value ) {
            $resultArr[$key] = $arr_data[$key];
        }

        return $resultArr;
    }

    /**
     * @param $data
     * @return array
     */
    public function SortAllData($data): array
    {
        if(!$data[0])
            return [0, $data[1]];
        else
        {
            $first = $data[1][0];
            $len = sizeof($first);
            unset($data[1][0]);
            $tmp = $this->ARRAY_sort_by_field($data[1], $len - 1, true);

            $reData[] = $first;
            foreach($tmp as $val)
                $reData[] = $val;

            return [1, $reData];
        }
    }
}
