@extends("layout")

@section("content")
    <head>
        <meta charset="UTF-8">
        <title>考核项目管理</title>
{{--        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">--}}
        <link href="{{ asset('assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
    </head>

    <div class="jumbotron" style="text-align: center">
        <h1>考核项目设置</h1>
        <p>请按照配置步骤逐一配置</p>
        {{--        <p></p>--}}
        {{--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
    </div>

{{--    <button id="btn">选择1</button>--}}

    <div class="panel panel-primary" hidden id="basicSetting">
        <div class="panel-heading">设置考核项目基本信息</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="projectName">考核项目名</label>
                <input type="text" class="form-control" id="name" maxlength="15" placeholder="输入小于15个字的名字">
            </div>
            <div class="form-group">
                <label for="projectName">项目开始时间</label>
                <input type="text" placeholder="点击输入时间" class="form-control form_datetime_start" id="start_at" data-date-format="yyyy-mm-dd HH:ii:ss">
            </div>
            <div class="form-group">
                <label for="projectName">项目结束时间</label>
                <input type="text" placeholder="点击输入时间" class="form-control form_datetime_start" id="end_at" data-date-format="yyyy-mm-dd HH:ii:ss">
            </div>
            <div class="form-group">
                <label for="projectName">设定工作流程</label>
                <select name="process" id="process" class="form-control">
                    <option value="1">提交数据需要审核</option>
                    <option value="2">直接提交无需审核</option>
                    <option value="3">只允许拥有数据管理员权限的用户提交</option>
                </select>
            </div>
            <button type="button" id="step01-btn" class="btn btn-default">下一步</button>
        </div>
    </div>

    <div class="panel panel-primary" hidden id="dataSetting">
        <div class="panel-heading">设置考核项目数据条目</div>
        <div class="panel-body">

            <div class="form-group">
                <label for="projectName">项目开始时间</label>
                <input type="text" placeholder="点击输入时间" class="form-control form_datetime_start" id="start_at" data-date-format="yyyy-mm-dd HH:ii:ss">
            </div>

            <button type="button" id="step01-btn" class="btn btn-default">下一步</button>
        </div>
    </div>
    <form>
        <div id="root">

        </div>
    </form>

    <script type="text/javascript" src="{{ asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ asset('assets/js/ProjectSetting.js') }}"></script>
    <script type="text/javascript">
        $('#basicSetting').removeAttr('hidden');

        var start = $('.form_datetime_start')
        start.datetimepicker({
           //language:  'fr',
           language : 'zh-CN',
           weekStart: 0,
           todayBtn:  1,
           autoclose: 1,
           todayHighlight: 1,
           startView: 2,
           forceParse: 0,
           showMeridian: 1
        });
        var end = $('.form_datetime_end')
        end.datetimepicker({
            //language:  'fr',
            language : 'zh-CN',
            weekStart: 0,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });

        $('#step01-btn').click(function (){
            step01();
            $('#basicSetting').attr('hidden', 'hidden');
            $('#dataSetting').removeAttr('hidden');
        });


    </script>
@stop
