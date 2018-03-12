@extends('layouts.app')

@section('content')
    <div class="col-md-9 mdui-color-white mdui-p-y-1 mdui-m-b-2 mdui-img-rounded">
        <!-- 新增文章form -->
        <alert
            type="info"
            content="我们希望道童图书馆能够成为一个让大家记录一些有意思、有意义东西的地方。我们希望大家能够遵守道童的相关约定，在记录不属于自己原创的东西时，应尊重原创作者，不要恶意转载！"></alert>

        <form action="{{ route('questions.store') }}" method="post">
            {{ csrf_field() }}

            <topics></topics>
            @if ($errors->has('topics'))
                <span class="help-block mdui-text-color-pink">
                    {{ $errors->first('topics') }}
                </span>
            @endif
            <div class="mdui-textfield">
                <input name="title" class="mdui-textfield-input" type="title" placeholder="问题标题" maxlength="20"/>
                @if ($errors->has('title'))
                    <span class="help-block mdui-text-color-pink">
                        {{ $errors->first('title') }}
                    </span>
                @endif
            </div>

            <div class="mdui-textfield">
                <textarea name="bio" class="mdui-textfield-input" placeholder="问题描述" maxlength="200"></textarea>
                @if ($errors->has('bio'))
                    <span class="help-block mdui-text-color-pink">
                        {{ $errors->first('bio') }}
                    </span>
                @endif
            </div>

            <button class="mdui-btn mdui-color-theme mdui-m-t-1">提交</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label-card></label-card>
        </div>
    </div>
@endsection
