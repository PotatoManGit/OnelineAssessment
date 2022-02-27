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

    <button id="btn">选择1</button>
    <div id="root"></div>
    <script type="text/javascript">
        $('#btn').click(function(){
            $('#root').html('<h1>选择了1</h1>');
        });
    </script>
@stop
