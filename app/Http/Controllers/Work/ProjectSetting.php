<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectSetting extends Controller
{
    public function ProjectSetting()
    {
        return view('work.projectSetting');
    }

}
