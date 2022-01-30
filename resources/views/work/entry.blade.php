@extends("admin/adminLayout")

@section("content_admin")
    <head>
        <meta charset="UTF-8">
        <title>用户管理</title>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/paging.css')}}" rel="external nofollow" />
    </head>

    <div class="jumbotron" style="text-align: center">
        <h1>用户管理</h1>
        <p>生成用户用户名密码，设置，删除管理员</p>
        <p>用户列表中的用户名密码是唯一的，把它们分发给每个用户以登录评教</p>
        {{--        <p></p>--}}
        {{--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
    </div>
    <div class="col-md-12 col-xs-12">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading" id="userList">用户列表</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        <th>项目名</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>流程</th>
                        <th>状态</th>
                        <th>完成评教时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $key=>$val)
                        <tr>
                            <td>{{ $key+1+($page-1)*10 }}</td>
                            <td>{{ $val->name }}</td>
                            <td><a href="javascript:alert('该用户的密码是：{{ $val->password }}')">查看密码</a></td>
                            <td>
                                @if($val->type == config('sjjs_userSystem.admin_user_type'))
                                    管理员
                                @else
                                    普通用户
                                @endif
                            </td>
                            <td>
                                @if($val->last_sign_in === null)
                                    他从来没登录
                                @else
                                    {{ date('Y-m-d H:i:s', $val->last_sign_in) }}
                                @endif
                            </td>
                            <td>
                                @if($val->status != 2)
                                    没有完成
                                @else
                                    <b>完成评教</b>
                                @endif
                            </td>
                            <td>
                                @if($val->finish_time === null)
                                    他没有完成评教
                                @else
                                    {{ date('Y-m-d H:i:s', $val->finish_time) }}
                                @endif
                            </td>
                            <td><a href="{{ url('admin/control?cmd=del_user&val-1='.$val->uid) }}">删除</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop
