@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="row ivu-card ivu-card-bordered mdui-m-b-2">
            <div class="ivu-card-body">
                <form action="{{ route('calligraphies.update', ['id' => $calligraphy->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <upload-img-list calligraphy="{{ $calligraphy }}"></upload-img-list>
                    @if ($errors->has('images'))
                        <span class="help-block mdui-text-color-theme-accent">
                            <strong>{{ $errors->first('images') }}</strong>
                        </span>
                    @endif
                    <div class="mdui-textfield">
                        <input name="title" class="mdui-textfield-input" type="title" value="{{ $calligraphy->title }}" placeholder="文章标题" maxlength="20"/>
                    </div>
                    @if ($errors->has('title'))
                        <span class="help-block mdui-text-color-theme-accent">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                    <div class="mdui-textfield">
                        <textarea class="mdui-textfield-input" name="bio" placeholder="描述" maxlength="200">{{ $calligraphy->bio }}</textarea>
                    </div>
                    @if ($errors->has('bio'))
                        <span class="help-block mdui-text-color-theme-accent">
                            <strong>{{ $errors->first('bio') }}</strong>
                        </span>
                    @endif

                    <button class="mdui-btn mdui-color-theme mdui-m-t-1">提交</button>
                </form>
            </div>
        </div>
    </div>
@endsection
