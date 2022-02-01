@extends("layout")

@section("content")
    <head>
        <meta charset="UTF-8">
        <title>信息录入</title>
    </head>

    <div class="jumbotron" style="text-align: center">
        <h1>信息录入</h1>
        <p>选择考核项目的一项进行数据录入</p>
        {{--        <p></p>--}}
        {{--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading" id="userList">考核项目列表</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>项目名</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>流程</th>
                        <th>状态</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $key=>$val)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $val['name'] }}</td>
                            <td>{{ date('Y-m-d H:i', $val['start_at']) }}</td>
                            <td>{{ date('Y-m-d H:i', $val['end_at']) }}</td>
                            <td>{{ config('kh_workProcessSetting.'.$val['process']) }}</td>
                            <td>
                                @if($val['status'] == 1)
                                    正常
                                @elseif($val['status'] == 2)
                                    终止
                                @endif
                            </td>
                            <td>{{ $val['note'] }}</td>
                            @if($val['process'] == 3)
                                <td><b>权限不足！</b></td>
                            @else
                                <td>
                                    <a href="{{ url('/work/data_entry/input?pid='.$val['pid']) }}">
                                    <button type="button" class="btn btn-primary btn-xs">录入</button>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop
