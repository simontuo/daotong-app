@extends('layouts.app')

@section('content')
<div class="container">
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
        <div class="mdui-card mdui-m-b-1">
            <div class="mdui-car-topic">
                <a class="topic" href="">laravel</a>
                <a class="topic" href="">Mysql</a>
                <a class="topic" href="">PHP</a>
            </div>
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" src="/avatars/avatar1.jpg"/>
                <div class="mdui-card-header-title">Siontuo</div>
                <div class="mdui-card-header-subtitle">一个魔法师</div>
            </div>
            <div class="mdui-card-primary mdui-p-y-0">
                <div class="mdui-card-primary-title"><h4>这是一个标题</h4></div>
            </div>
            <div class="mdui-card-content mdui-p-t-0 mdui-p-b-1">
                <div class="row">
                    <div class="col-md-3">
                        <img class="mdui-img-fluid mdui-img-rounded" src="/avatars/1.jpg" alt="">
                    </div>
                    <div class="col-md-9">
                        <p>
                            子曰：「学而时习之，不亦说乎？有朋自远方来，不亦乐乎？人不知，而不愠，不亦君子乎？」
                            子曰：「学而时习之，不亦说乎？有朋自远方来，不亦乐乎？人不知，而不愠，不亦君子乎？」
                        </p>
                    </div>
                </div>
            </div>
            <div class="mdui-card-actions">
                <div class="mdui-btn-group">
                    <button class="mdui-btn mdui-ripple mdui-color-blue-50 mdui-text-color-blue-800">
                        <i class="mdui-icon mdui-icon-left material-icons">&#xe8dc;</i>711
                    </button>
                    <button class="mdui-btn mdui-ripple">
                        <i class="mdui-icon mdui-icon-left material-icons">&#xe0ca;</i>
                        35条评论
                    </button>
                    <button class="mdui-btn mdui-ripple">
                        <i class="mdui-icon mdui-icon-left material-icons">&#xe838;</i>
                        收藏
                    </button>
                </div>
            </div>
        </div>

        <div class="mdui-card mdui-m-b-1">
            <div class="mdui-car-topic">
                <a class="topic" href="">laravel</a>
                <a class="topic" href="">Mysql</a>
                <a class="topic" href="">PHP</a>
            </div>
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" src="/avatars/avatar1.jpg"/>
                <div class="mdui-card-header-title">Siontuo</div>
                <div class="mdui-card-header-subtitle">一个魔法师</div>
            </div>
            <div class="mdui-card-primary mdui-p-y-0">
                <div class="mdui-card-primary-title"><h4>这是一个标题</h4></div>
            </div>
            <div class="mdui-card-content mdui-p-t-0 mdui-p-b-1">
                <div class="row">
                    <div class="col-md-3">
                        <img class="mdui-img-fluid mdui-img-rounded" src="/avatars/1.jpg" alt="">
                    </div>
                    <div class="col-md-9">
                        <p>
                            子曰：「学而时习之，不亦说乎？有朋自远方来，不亦乐乎？人不知，而不愠，不亦君子乎？」
                            子曰：「学而时习之，不亦说乎？有朋自远方来，不亦乐乎？人不知，而不愠，不亦君子乎？」
                        </p>
                    </div>
                </div>
            </div>
            <div class="mdui-card-actions">
                <div class="mdui-btn-group">
                    <button class="mdui-btn mdui-ripple mdui-color-blue-50 mdui-text-color-blue-800">
                        <i class="mdui-icon mdui-icon-left material-icons">&#xe8dc;</i>711
                    </button>
                    <button class="mdui-btn mdui-ripple">
                        <i class="mdui-icon mdui-icon-left material-icons">&#xe0ca;</i>
                        35条评论
                    </button>
                    <button class="mdui-btn mdui-ripple">
                        <i class="mdui-icon mdui-icon-left material-icons">&#xe838;</i>
                        收藏
                    </button>
                </div>
            </div>
        </div>

    </div>

    @include('layouts.rightBar')
</div>
@endsection
