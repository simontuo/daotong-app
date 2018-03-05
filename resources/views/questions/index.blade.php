@extends('layouts.app')

@section('content')

<div class="hidden-md hidden-lg col-md-1">
    <button class="mdui-m-b-2 mdui-btn mdui-ripple mdui-color-white" onclick="window.location='{{ route('articles.index') }}'">文章</button>
    <button class="mdui-m-b-2  mdui-btn mdui-ripple mdui-color-white" onclick="window.location='{{ route('calligraphies.index') }}'">书法</button>
    <button class="mdui-m-b-2  mdui-btn mdui-ripple mdui-color-theme-accent">问答</button>
</div>
<div class="col-md-11">
    <question-list></question-list>
</div>

@endsection
