<?php

namespace App\Exports\DataResultExport;

use App\Exports\DataResultExport\DataResultExportOne;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

/**
 * Class EvaluationResultExport
 * @package App\Exports
 */
class DataResultExport implements WithMultipleSheets
{
    use Exportable;

    protected array $data;
    protected array $need;

    public function __construct(array $data, array $need)
    {
        $this->need = $need;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        foreach($this->need as $now=>$val)
        {
            $sheets[] = new DataResultExportOne($this->data, $now, $val);
        }
        return $sheets;
    }
}
