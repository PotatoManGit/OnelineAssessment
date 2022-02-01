@extends("layout")

@section("content")

    <head><title>数据审核</title></head>

    <div class="jumbotron" style="text-align: center">
        <h1>数据审核</h1>
        <p>在“需要通过审核”工作流程下，数据审核员通过这个页面决定数据提交是否上传至数据库</p>
        <p>“通过并上传”将直接上传数据库，“保留重审”将保留在临时待审数据中，“驳回”将从临时数据库删除</p>
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
                        <th>录入用户</th>
                        <th>录入支部</th>
                        <th>数据</th>
                        <th>录入时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $key=>$val)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $dbp->GetNameByPid($val['pid']) }}</td>
                            <td>{{ $dbu->GetUsernameByUid($val['uid']) }}</td>
                            <td>{{ $dbc->GetNameByCid($val['cid']) }}</td>
                            <td><a href="javascript:alert('数据为：\n {{ $tmpData[$key] }}')">查看数据</a></td>
                            <td>{{ date('Y-m-d H:i', $val['update_at']) }}</td>
                            <td>
                                @if($val['status'] == 1)
                                    待审核
                                @elseif($val['status'] == 3)
                                    保留重审
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/work/data_audit/check?tid='.$val['tid'].'&status=1') }}">
                                    <button type="button" class="btn btn-primary btn-xs">通过并上传</button>
                                </a>
                                <a href="{{ url('/work/data_audit/check?tid='.$val['tid'].'&status=2') }}">
                                    <button type="button" class="btn btn-primary btn-xs">保留重审</button>
                                </a>
                                <a href="{{ url('/work/data_audit/check?tid='.$val['tid'].'&status=3') }}">
                                    <button type="button" class="btn btn-primary btn-xs">驳回</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@stop
