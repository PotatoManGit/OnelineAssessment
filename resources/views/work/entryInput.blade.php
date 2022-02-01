@extends("layout")

@section("content")

    <head><title>录入信息</title></head>

    <div class="jumbotron" style="text-align: center">
        <h1>录入信息</h1>
        <p>请在以下表单中录入信息</p>
        {{--        <p></p>--}}
        {{--        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>--}}
    </div>

    <div class="col-md-12 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">录入信息</div>
            <div class="panel-body">
                <form method="post" action="{{ url('/work/entry/input/check') }}" class="form-horizontal">
                    @foreach($data['setting'] as $key=>$val)
                        @if($val->type == 'list')
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">{{ $val->name }}</label>
                                <div class="col-sm-10">
                                    @foreach($val->item as $key=>$item)
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="{{ 'list-'.$key }}" value="{{ 'list-'.$key }}">
                                            {{ $item }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($val->type == 'num')
                           <div class="form-group">
                               <label for="inputEmail3" class="col-sm-2 control-label">{{ $val->name }}</label>
                               <div class="col-sm-10">
                                   <input type="number" class="form-control" name="" id="inputEmail3" placeholder="{{ $val->name }}">
                               </div>
                           </div>
                        @elseif($val->type == 'text')
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">{{ $val->name }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="text">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="{{ $val->name }}">
                                    </textarea>

                                </div>
                            </div>
                        @elseif($val->type == 'bool')
                        @endif
                    @endforeach
{{--                    <div class="form-group">--}}
{{--                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="col-sm-offset-2 col-sm-10">--}}
{{--                            <div class="checkbox">--}}
{{--                                <label>--}}
{{--                                    <input type="checkbox"> Remember me--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
