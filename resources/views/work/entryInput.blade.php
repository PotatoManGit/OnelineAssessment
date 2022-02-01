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
                <form method="post" action="{{ url('/work/data_entry/input/check?pid='.$pid) }}" class="form-horizontal">
                    @csrf
                    @foreach($data['setting'] as $key=>$val)
                        @if($val['type'] == 'list')
                            <div class="form-group">
                                <label for="optionsRadios" class="col-sm-2 control-label">{{ $val['name'] }}</label>
                                <div class="col-sm-10">
                                    @foreach($val['item'] as $i=>$item)
                                        <label class="radio-inline">
                                            <input type="radio" name="{{ $key }}" required
                                                   id="{{ $key }}" value="{{ $i }}">
                                            {{ $dbc->GetNameByCid($item) }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @elseif($val['type'] == 'num')
                           <div class="form-group">
                               <label for="inputEmail3" class="col-sm-2 control-label">{{ $val['name'] }}</label>
                               <div class="col-sm-10">
                                   <input type="number" class="form-control" name="{{ $key }}" required
                                          id="inputEmail3" placeholder="请输入数字 9位以内" max="999999999" min="-999999999">
                               </div>
                           </div>
                        @elseif($val['type'] == 'text')
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">{{ $val['name'] }}</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="4" name="{{ $key }}" required
                                              placeholder="请输入内容 400字以内" maxlength="400"></textarea>
                                </div>
                            </div>
                        @elseif($val['type'] == 'bool')
                            <div class="form-group">
                                <label for="optionsRadios" class="col-sm-2 control-label">{{ $val['name'] }}</label>
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input type="radio" name="{{ $key }}" required
                                               id="{{ $key }}" value="1">
                                        是
                                    </label><label class="radio-inline">
                                        <input type="radio" name="{{ $key }}" required
                                               id="{{ $key }}" value="0">
                                        否
                                    </label>
                                </div>
                            </div>
                        @endif
                    @endforeach
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
