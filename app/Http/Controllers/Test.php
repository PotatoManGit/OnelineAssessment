<?php

namespace App\Http\Controllers;

use App\Http\Controllers\System\DataProcessing;
use App\Models\OA_Class;
use App\Models\OA_Project;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function Test()
    {
        $i = new DataProcessing();
        $data = $i->SortAllData($i->AllDataCalculate()[1]);
        echo "<pre>";print_r($data);echo "<pre>";
        return 0;
    }
}
