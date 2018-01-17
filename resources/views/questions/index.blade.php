@extends('layouts.app')

@section('content')

<div class="hidden-xs hidden-sm col-md-1 mdui-m-y-1">
    <button class="mdui-m-b-2 mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white" onclick="window.location='{{ route('articles.index') }}'">文章</button>
    <button class="mdui-m-b-2  mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white" onclick="window.location='{{ route('calligraphys.index') }}'">书法</button>
    <button class="mdui-m-b-2  mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" onclick="window.location='{{ route('questions.index') }}'">问答</button>
</div>
<div class="hidden-md hidden-lg col-md-1">
    <button class="mdui-m-b-2 mdui-btn mdui-ripple mdui-color-white" onclick="window.location='{{ route('articles.index') }}'">文章</button>
    <button class="mdui-m-b-2  mdui-btn mdui-ripple mdui-color-white" onclick="window.location='{{ route('calligraphys.index') }}'">书法</button>
    <button class="mdui-m-b-2  mdui-btn mdui-ripple mdui-color-theme-accent">问答</button>
</div>
<div class="col-md-8">
    <question-list></question-list>
</div>
<div class="col-md-3">
    <label-card></label-card>
</div>

@endsection
