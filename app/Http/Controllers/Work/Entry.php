<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\ProjectControl;
use Illuminate\Http\Request;

class Entry extends Controller
{
    public function Entry()
    {
        $data = (new ProjectControl())->ListAll();
        view('work.entry', compact('data'));
    }
}
