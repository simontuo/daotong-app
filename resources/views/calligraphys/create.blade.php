@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <!-- 新增文章form -->
        <alert
            type="info"
            content="我们希望道童图书馆能够成为一个让大家记录一些有意思、有意义东西的地方。我们希望大家能够遵守道童的相关约定，在记录不属于自己原创的东西时，应尊重原创作者，不要恶意转载！"></alert>

        <form action="{{ route('calligraphys.store') }}" method="post">
            {{ csrf_field() }}

            <upload-img-list></upload-img-list>
            @if ($errors->has('images'))
                <span class="help-block mdui-text-color-theme-accent">
                    <strong>{{ $errors->first('images') }}</strong>
                </span>
            @endif
            <div class="mdui-textfield">
                <input name="title" class="mdui-textfield-input" type="title" placeholder="文章标题" maxlength="20"/>
            </div>
            @if ($errors->has('title'))
                <span class="help-block mdui-text-color-theme-accent">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
            <div class="mdui-textfield">
                <textarea class="mdui-textfield-input" name="bio" placeholder="描述" maxlength="200"></textarea>
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
@endsection
