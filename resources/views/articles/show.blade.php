@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <div class="row ivu-card ivu-card-bordered mdui-m-b-2">
            <div class="ivu-card-body">
                <!-- alert -->
                <div class="mdui-m-b-2">
                    <alert
                        type="info"
                        content="我们希望道童图书馆能够成为一个让大家记录一些有意思、有意义东西的地方。我们希望大家能够遵守道童的相关约定，在记录不属于自己原创的东西时，应尊重原创作者，不要恶意转载！"></alert>
                </div>
                <!-- head -->
                <div class="article-head mdui-m-b-2">
                    <h2 class="mdui-m-b-1">{{ $article->title }}</h2>
                    <div  style="font-size:13px;text-align: center;margin-bottom: 5%">
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe192;</i> {{ $article->created_at->diffForHumans() }} -
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe417;</i> {{ $article->reads_count }} -
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe8dc;</i> 12 -
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe0b7;</i> 11
        			</div>
                </div>
                <!-- bio -->
                <div class="markdown-body code-github mdui-m-b-2">
                    {!! $article->bio !!}
                    <blockquote>
                        <p><i class="mdui-icon material-icons mdui-text-color-theme-accent" mdui-tooltip="{content: '作者署名'}">&#xe55a;</i> : {{ $article->authors->settings['bio'] }}</p>
                    </blockquote>
                </div>
            </div>
        </div>
        <!-- like-card -->
        <div class="row mdui-m-b-2">
            <!-- like-card -->
            <like-card></like-card>
        </div>
        <!-- comment-list -->
        <div class="row mdui-m-b-2">
            <!-- comment-->
            <comment></comment>
        </div>
    </div>



    @include('layouts.rightBar')
</div>
@endsection
