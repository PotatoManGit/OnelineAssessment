@extends("layout")

@section("content")


    <div>
        @if($result == '1')
            <div class="alert alert-success" role="alert"><center><h1>{{ $data }}<br/>
                    <b><a href="{{ url()->previous().'?of=1' }}">点击返回</a></b></h1></center></div>
        @elseif($result == '0')
            <div class="alert alert-danger" role="alert"><center><h1>{{ $data }}<br/>
                        <b><a href="{{ url('/about/help') }}">点击获取帮助</a></b></h1><center></div>
        @else
            <div class="alert alert-success" role="alert"><center><h1>{{ $data }}<br/>
                        <b><a href="{{ url($result.'?of=1') }}">点击返回</a></b></h1></center></div>
        @endif
    </div>
@stop
