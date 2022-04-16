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
                <select name="process" id="process" required class="form-control">
                    <option value="1">提交数据需要审核</option>
                    <option value="2">直接提交无需审核</option>
                    <option value="3">只允许拥有数据管理员权限的用户提交</option>
                </select>
            </div>
            <div class="form-group">
                <label for="projectName">项目类型</label>
                <select name="process" id="status" required class="form-control">
                    <option value="1">单次考核项目（比如一个活动，每个班只可以录入一次数据）</option>
                    <option value="2">长时间考核项目（比如查团徽，每个班可以多次录入数据）</option>
                </select>
            </div>
            <div class="form-group">
                <label>参与考核的团支部</label><br/>
                <label class="checkbox-inline">
                    <input type="checkbox" name="kh-class" value="1"> 高一
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="kh-class" value="2"> 高二
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="kh-class" value="3"> 高三
                </label>
            </div>
            <div class="form-group" id="step01-err-em" hidden>
                <label style="color: red">有信息尚未填写，请填写！</label>
            </div>

            <button type="button" id="step01-btn" class="btn btn-default">下一步</button>
        </div>
    </div>

    <div class="panel panel-primary" hidden id="dataSetting">
        <div class="panel-heading">设置考核项目数据条目</div>
        <div class="panel-body">
            <label for="num"></label><input hidden id="num" value="1">
            <div class="form-group">
                <label for="data-show">数据条目信息（无需且不可编辑）</label>
                <textarea class="form-control" id="data-show" rows="3" disabled></textarea>
            </div>
            <div class="form-group">
                <label for="data-name">信息条目名称</label>
                <input type="text" class="form-control" id="data-name" maxlength="20" placeholder="输入小于20个字的名字">
            </div>
            <div class="form-group">
                <label for="data-type">信息条目类型</label>
                <select name="process" id="data-type" required class="form-control">
                    <option value="num">数字num（包括小数，9位以内，可以参与计算）</option>
                    <option value="text">文本内容text（400字以内，仅用作备注，不可以参与计算）</option>
                    <option value="bool">布尔数bool（选项为是或否，可以参与计算，计算时按照：选择是为1，选择否为0计算）</option>
                </select>
            </div>
            <div class="form-group" id="step02-err-em" hidden>
                <label style="color: red">有信息尚未填写，请填写！</label>
            </div>
            <button type="button" id="step02-btn-add" class="btn btn-default">保存-添加一项</button>
            <button type="button" id="step02-btn-next" class="btn btn-default">保存-下一步</button>
        </div>
    </div>
    <div class="panel panel-primary" hidden id="formula-setting">
        <div class="panel-heading">设置公式</div>
        <div class="panel-body">
            说明：~~~未完成~~~好懒啊~~~累了~~~睡了~~~^_^！
            <div class="form-group">
                <label for="fo-data-show">数据条目信息（无需且不可编辑）</label>
                <textarea class="form-control" id="fo-data-show" rows="3" disabled></textarea>
            </div>
            <div class="form-group">
                <label for="formula">请输入公式   result=</label>
                <input type="text" class="form-control" id="formula" maxlength="100" placeholder="输入小于100个字符的公式">
            </div>
            <div class="form-group" id="step03-err-em" hidden>
                <label style="color: red">请正确填写公式！</label>
            </div>
            <button type="button" id="step03-btn" class="btn btn-default">提交-下一步</button>
        </div>
    </div>
    <div class="panel panel-primary" hidden id="finish">
        <div class="panel-heading">设置考核项目数据条目</div>
        <div class="panel-body">
            <div class="form-group">
                <label><h1>已经完成了所有设置</h1></label><br/>
                <a href="{{ url('/work/project_setting/edit/check/?status=ok') }}"><button type="button" id="finish" class="btn btn-default">点击提交</button></a>
            </div>

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
            if(step01())
            {
                $('#basicSetting').attr('hidden', 'hidden');
                $('#dataSetting').removeAttr('hidden');
            }
            else
                $('#step01-err-em').removeAttr('hidden');
        });

        $('#step02-btn-add').click(function (){
            if(step02($('#num').val())) {
                $('#data-name').val(null);
                $('#data-type').val(1);
            }
            else
                $('#step02-err-em').removeAttr('hidden');
        });

        $('#step02-btn-next').click(function () {
            if(Number($('#num').val()) === 1)
                $('#step02-err-em').removeAttr('hidden');
            else
            {
                $('#dataSetting').attr('hidden', 'hidden');
                $('#formula-setting').removeAttr('hidden');
            }

            step03_0();
        });

        $('#step03-btn').click(function () {
            if(step03()) {
                $('#formula-setting').attr('hidden', 'hidden');
                $('#finish').removeAttr('hidden');
            }
            else
                $('#step03-err-em').removeAttr('hidden');
        })

        // $('#step02-btn-next').click(function () {
        //     $('#dataSetting').attr('hidden', 'hidden');
        //     $('#finish').removeAttr('hidden');
        // });

    </script>
@stop
