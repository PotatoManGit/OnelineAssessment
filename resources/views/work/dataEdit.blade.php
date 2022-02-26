@extends("layout")

@section("content")

    <head><title>数据编辑</title></head>

    <div class="jumbotron" style="text-align: center">
        <h1>数据编辑</h1>
        <p>数据管理员在这里编辑已有数据</p>
        <p>点击编辑，即可编辑数据。点击删除，可以删除该班级在该项目下的考核数据。点击退回重审，可以让该条目移除并重新接受审核</p>
        {{--        <p></p>--}}
        {{--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading" id="userList">所选班级的所有审核项目</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th>项目名</th>
                        <th>录入用户</th>
                        <th>录入支部</th>
                        <th>数据</th>
                        <th>最新修改时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $key=>$val)
                        @if($val['cid'] == $cid)
                            <tr>
                                <td>{{ $dbp->GetNameByPid($val['pid']) }}</td>
                                <td>{{ $dbu->GetUsernameByUid($val['uid']) }}</td>
                                <td>{{ $dbc->GetNameByCid($val['cid']) }}</td>
                                <td><a href="javascript:alert('数据为：\n {{ $tmpData[$key] }}')">查看数据</a></td>
                                <td>{{ date('Y-m-d H:i', $val['update_at']) }}</td>
                                <td>
                                    <a href="{{ url('/work/data_entry/input?pid='.$val['pid'].'&type=edit&cid='.$cid.'&did='.$val['did']) }}">
                                        <button type="button" class="btn btn-primary btn-xs">编辑</button>
                                    </a>
                                    <a href="{{ url('/work/data_regulate/regulate/check?cid='.$cid.'&cmd=del&did='.$val['did']) }}">
                                        <button type="button" class="btn btn-primary btn-xs">删除</button>
                                    </a>
                                    <a href="{{ url('/work/data_regulate/regulate/check?cid='.$cid.'&cmd=again&did='.$val['did']) }}">
                                        <button type="button" class="btn btn-primary btn-xs">退回重审</button>
                                    </a>
                                </td>
                            </tr>
                        @else
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@stop
