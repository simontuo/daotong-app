@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <!-- laravel flash -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <!-- 工具栏 -->
        <Card class="mdui-m-b-2">
            <div class="mdui-toolbar">
                <!-- <a href="{{ url('/') }}" class="mdui-btn mdui-ripple">
                    <i class="mdui-icon mdui-icon-left material-icons">&#xe6dd;</i>诗集
                </a> -->
                <a href="{{ url('/') }}" class="mdui-btn mdui-ripple">
                    <i class="mdui-icon mdui-icon-left material-icons">&#xe865;</i>文章
                </a>
                <a href="{{ url('/') }}" class="mdui-btn mdui-ripple">
                    <i class="mdui-icon mdui-icon-left material-icons">&#xe0c6;</i>问道
                </a>
            </div>
        </Card>
        <article-list></article-list>
</div>
@endsection

@section('rightBar')
    <div class="col-md-3">
        <ranking-list></ranking-list>
    </div>
@endsection
