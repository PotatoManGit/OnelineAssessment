<?php

namespace App\Exports\DataResultExport;

use App\Models\OA_Class;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DataResultExportOne implements FromArray,WithTitle
{
    protected array $data;
    protected int $now;
    protected int $index;

    /**
     * EvaluationResultExport constructor.
     * @param array $data
     * @param int $now
     * @param int $index
     */
    public function __construct(array $data, int $now, int $index)
    {
        $this->data = $data;
        $this->now = $now;
        $this->index = $index;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->data[$this->now];
    }

    public function title(): string
    {
        $tmp = $this->index;
        if($tmp == 1)
            return '高一年级';
        elseif($tmp == 2)
            return '高二年级';
        elseif($tmp == 3)
            return '高三年级';
        else
            return '检测出错误年级，推测为数据错误，请检查';
    }
}
