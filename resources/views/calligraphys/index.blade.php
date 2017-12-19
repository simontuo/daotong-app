
@extends('layouts.app')

@section('content')
<div class="hidden-xs hidden-sm col-md-1 mdui-m-y-1">
    <button class="mdui-m-b-2 mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white" onclick="window.location='{{ route('articles.index') }}'">文章</button>
    <button class="mdui-m-b-2  mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white mdui-color-theme-accent" onclick="window.location='{{ route('calligraphys.index') }}'">书法</button>
    <button class="mdui-m-b-2  mdui-center mdui-btn mdui-btn-raised mdui-ripple mdui-color-white">问答</button>
</div>
<div class="hidden-md hidden-lg col-md-1">
    <button class="mdui-m-b-2 mdui-btn mdui-ripple mdui-color-white" onclick="window.location='{{ route('articles.index') }}'">文章</button>
    <button class="mdui-m-b-2  mdui-btn mdui-ripple mdui-color-white mdui-color-theme-accent" onclick="window.location='{{ route('calligraphys.index') }}'">书法</button>
    <button class="mdui-m-b-2  mdui-btn mdui-ripple mdui-color-white">问答</button>
</div>
<div class="col-md-11">
    <calligraphy-list></calligraphy-list>
</div>

@endsection
