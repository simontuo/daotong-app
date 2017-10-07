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
        <div class="mdui-toolbar mdui-shadow-1 mdui-m-b-2">
            <a href="{{ url('/') }}" class="mdui-btn mdui-ripple">
                <i class="mdui-icon mdui-icon-left material-icons">&#xe6dd;</i>诗集
            </a>
            <a href="{{ url('/') }}" class="mdui-btn mdui-ripple">
                <i class="mdui-icon mdui-icon-left material-icons">&#xe865;</i>文章
            </a>
            <a href="{{ url('/') }}" class="mdui-btn mdui-ripple">
                <i class="mdui-icon mdui-icon-left material-icons">&#xe0c6;</i>问道
            </a>
        </div>

        <!-- 卡片流 -->
        @foreach($articles as $article)
            <div class="mdui-card mdui-m-b-1">
            <div class="mdui-car-topic">
                <a class="topic" href="">laravel</a>
                <a class="topic" href="">Mysql</a>
                <a class="topic" href="">PHP</a>
            </div>
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" src="{{ $article->user->avatar }}"/>
                <div class="mdui-card-header-title">{{ $article->user->name }}</div>
                <div class="mdui-card-header-subtitle">{{ $article->user->settings['bio'] }}</div>
            </div>
            <div class="mdui-card-media mdui-m-b-0">
                <a href="{{ route('articles.show', ['id' => $article->id] ) }}"><img src="{{ $article->cover }}"/></a>

                <div class="mdui-card-menu">
                <button class="mdui-btn mdui-btn-icon mdui-text-color-theme"><i class="mdui-icon material-icons">share</i></button>
                </div>
            </div>
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">{{ $article->title }}</div>
            </div>
            <div class="mdui-card-actions mdui-m-x-1 mdui-m-t-0">
                <span class="mdui-float-right article-card-icons mdui-m-x-1 mdui-text-color-teal"><i class="mdui-icon material-icons">&#xe0b9;</i> {{ $article->comments_count }} </span>
                <span class="mdui-float-right article-card-icons mdui-m-x-1
                {{ $article->has_liked() ? 'mdui-text-color-theme-accent' : 'mdui-card-header-subtitle' }}"><i class="mdui-icon material-icons">&#xe87d;</i> {{ $article->likes()->count() }}</span>
                <span class="mdui-float-right article-card-icons mdui-m-x-1 mdui-text-color-theme"><i class="mdui-icon material-icons">&#xe417;</i> {{ $article->reads_count }}</span>
              </div>
        </div>
        @endforeach
</div>
@endsection

@section('rightBar')
    <div class="col-md-3">
        <ranking-list></ranking-list>
    </div>
@endsection
