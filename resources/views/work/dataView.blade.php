@extends("layout")

@section("content")

    @if($mode == 1)
        <head>
            <meta charset="UTF-8">
            <title>数据管理</title>
        </head>
        <div class="jumbotron" style="text-align: center">
            <h1>数据查询，管理和导出</h1>
            <p>在此显示团支部的分数数据</p>
            <p>默认显示所有数据，如果要进行筛选，请在下方筛选栏中进行相关操作</p>
            <p><b>进行筛选后，请务必先点击查询，查询成功后再点击导出</b></p>
            <p>点击操作栏的<b>编辑</b>进行数据管理</p>
            {{--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
        </div>
    @else
        <head>
            <meta charset="UTF-8">
            <title>数据查询</title>
        </head>
        <div class="jumbotron" style="text-align: center">
            <h1>数据查询和导出</h1>
            <p>在此显示团支部的分数数据</p>
            <p>默认显示所有数据，如果要进行筛选，请在下方筛选栏中进行相关操作</p>
            <p><b>进行筛选后，请务必先点击查询，查询成功后再点击导出</b></p>
            {{--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
        </div>
    @endif


    <div class="panel panel-default ">
        @if($mode == 1)
            <form class="form-inline" method="post" action="{{ url('work/data_regulate/check') }}">
        @else
            <form class="form-inline" method="post" action="{{ url('work/data_view/check') }}">
        @endif
            @csrf
            <div class="panel-body container-fluid ">
                <div class="form-group">
                    请选择要查询的年级：
                </div>
                <div class="checkbox">
                    <label>
                        <input name="class[]" value="-1" type="checkbox">
                        全部
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="class[]" value="1" type="checkbox">
                        高一
                    </label>

                </div>
                <div class="checkbox">
                    <label>
                        <input name="class[]" value="2" type="checkbox">
                        高二
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input name="class[]" value="3" type="checkbox">
                        高三
                    </label>
                </div>
                <div class="form-group col-md-offset-1">
                    是否按分数排序(默认按支部序号排序)：
                </div>
                <div class="checkbox">
                    <label>
                        <input name="sort[]" value="1" type="checkbox">
                        排序
                    </label>
                </div>
                <div class="form-group col-md-offset-2"></div>

                <button type="submit" class="btn btn-primary">查询</button>
                @if($mode == 1)
                        <a href="{{ url('work/data_regulate?class='.$needStr.'&sort='.$sort.'&export=download') }}">
                            <button type="button" class="btn btn-primary">导出当前</button>
                        </a>

                @else

                        <a href="{{ url('work/data_view?class='.$needStr.'&sort='.$sort.'&export=download') }}">
                            <button type="button" class="btn btn-primary">导出当前</button>
                        </a>

                @endif
            </div>
        </form>
    </div>


    <div class="col-md-12 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading" id="userList"><b>考核数据{{ $str }} | (数据为0可能是该数据不存在)</b></div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th>#</th>
                        @foreach($head as $item)
                            @if($item == 'cid')
                                <th>支部(班级)</th>
                            @elseif($item == 'sm')
                                <th>总分</th>
                            @else
                                <th><b>{{ $dbp->GetNameByPid($item) }}</b>得分</th>
                            @endif
                        @endforeach
                        @if($mode == 1)
                            <th>操作</th>
                        @endif
                    </tr>
                    @foreach($data as $key=>$val)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            @foreach($head as $i=>$item)
                                @if($item == 'cid')
                                    <td>{{ $dbc->GetNameByCid($val[$i]) }}</td>
                                @elseif($item == 'sm')
                                    <td>{{ $val[$i] }}</td>
                                @else
                                    <td>{{ $val[$i] }}</td>
                                @endif
                            @endforeach

                            @if($mode == 1)
                                <td>
                                    <a href="{{ url('/work/data_regulate/regulate/check?cid='.$val[0]) }}">
                                        <button type="button" class="btn btn-primary btn-xs">编辑</button>
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
