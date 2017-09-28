@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <!-- alert -->
        <div class="mdui-m-b-2">
            <alert
                type="info"
                content="我们希望道童图书馆能够成为一个让大家记录一些有意思、有意义东西的地方。我们希望大家能够遵守道童的相关约定，在记录不属于自己原创的东西时，应尊重原创作者，不要恶意转载！"></alert>
        </div>
        <!-- head -->
        <div class="article-head mdui-m-b-3">
            <h3 class="mdui-m-b-1">{{ $article->title }}</h3>
            <span>{{ $article->created_at->diffForHumans() }}</span>
            <span>{{ $article->created_at->diffForHumans() }}</span>
        </div>
        <!-- bio -->
        <div class="markdown-body code-github mdui-m-b-2">
            {!! $article->bio !!}
        </div>
        <!-- like-card -->
        <like-card></like-card>
    </div>

    @include('layouts.rightBar')
</div>
@endsection
