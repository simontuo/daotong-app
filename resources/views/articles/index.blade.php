@extends('layouts.app')

@section('content')
<div class="col-md-2 mdui-m-y-1">

        <button class="mdui-m-b-2 mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent mdui-btn-block">热门文章</button>

        <button class="mdui-m-b-2  mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white mdui-btn-block">最新文章</button>

        <button class="mdui-m-b-2  mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white mdui-btn-block">评论最多</button>

        <button class="mdui-m-b-2  mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white mdui-btn-block">点赞最多</button>


</div>
<div class="col-md-10">
    <article-list></article-list>
</div>

@endsection
