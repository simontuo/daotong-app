@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <!-- 新增文章form -->
        <alert
            type="info"
            content="我们希望道童图书馆能够成为一个让大家记录一些有意思、有意义东西的地方。我们希望大家能够遵守道童的相关约定，在记录不属于自己原创的东西时，应尊重原创作者，不要恶意转载！"></alert>

        <form action="{{ route('articles.store') }}" method="post">
            {{ csrf_field() }}

            <upload-img-list></upload-img-list>

            <div class="mdui-textfield">
                <input name="title" class="mdui-textfield-input" type="title" placeholder="文章标题" maxlength="20"/>
            </div>

            <button class="mdui-btn mdui-color-theme mdui-m-t-1">提交</button>
        </form>
    </div>
</div>
@endsection
