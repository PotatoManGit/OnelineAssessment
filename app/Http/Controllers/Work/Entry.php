<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\ProjectControl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Entry extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function Entry()
    {
        $data = (new ProjectControl())->ListAll();
        return view('work.entry', compact('data'));
    }

    public function EntryInput(Request $request)
    {
        if(empty($request['pid']))
        {
            echo '<script language="JavaScript">;alert("请先选择一项审核项目")</script>;';
            return redirect('/data_entry');
        }
        $data = (new ProjectControl())->GetOneForInput((int)$request['pid']);
        return view('work.entryInput', compact('data'));
    }
}
