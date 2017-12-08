@extends('layouts.app')

@section('content')
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
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe8dc;</i> {{ $article->likes()->count() }} -
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe0b7;</i> {{ $article->comments_count }}
        			</div>
                </div>
                <!-- bio -->
                <div class="markdown-body code-github mdui-m-b-2">
                    {!! $article->bio !!}
                    <blockquote>
                        <p>
                            <i class="mdui-icon material-icons mdui-text-color-theme-accent" mdui-tooltip="{content: '作者署名'}">&#xe55a;</i> : {{ $article->author->settings['bio'] }}
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
        <!-- like-card -->
        <div class="row mdui-m-b-2">
            <!-- like-card -->
            <like-card model="{{ $article->id }}" type="Article" code="{{ array_has($article->user->settings, 'wechatCode') ? $article->user->settings['wechatCode'] : '' }}"></like-card>
        </div>
        <!-- comment-list -->
        <div class="row mdui-m-b-2">
            <!-- comment-->
            <comment-list title="{{ $article->title }}" model="{{ $article->id }}" type="Article"></comment-list>
        </div>
    </div>
@endsection

@section('rightBar')
    <div class="col-md-3">
        @if($article->user_id != $article->author_id)
            <div class="mdui-card mdui-m-b-2 mdui-color-theme-accent">
                <div class="mdui-valign mdui-m-y-2">
                    <p class="mdui-center" style="font-size:18px">创建者信息</p>
                </div>
                <div class="mdui-valign mdui-m-y-2">
                    <p class="mdui-center like-avatar"><img src="{{ $article->user->avatar }}" /></p>
                </div>
                <div class="mdui-valign mdui-m-y-1">
                    <p class="mdui-center"><span class="label label-success">{{ $article->user->name }}</span></p>
                </div>
                <div class="mdui-valign mdui-m-b-2">
                    <p class="mdui-center">
                        <span>已关注：{{ $article->user->followers_count }}</span>
                        <span>被关注：{{ $article->user->followings_count }}</span>
                        <span>文章：311</span>
                        <span>评论：{{ $article->user->comments_count }}</span>
                    </p>
                </div>
            </div>
        @endif
        <div class="mdui-card mdui-m-b-2">
            <div class="mdui-valign mdui-m-y-2">
                <p class="mdui-center" style="font-size:18px">作者信息</p>
            </div>
            <div class="mdui-valign mdui-m-y-2">
                <p class="mdui-center like-avatar"><img src="{{ $article->author->avatar }}" /></p>
            </div>
            <div class="mdui-valign mdui-m-y-2">
                <p class="mdui-center"><span class="label label-success">{{ $article->author->name }}</span></p>
            </div>
            <div class="mdui-valign mdui-m-b-2">
                <p class="mdui-center">
                    <span>已关注：{{ $article->user->followers_count }}</span>
                    <span>被关注：{{ $article->user->followings_count }}</span>
                    <span>文章：311</span>
                    <span>评论：{{ $article->user->comments_count }}</span>
                </p>
            </div>
            <div class="mdui-valign mdui-m-b-2">
                <p class="mdui-center">
                    <user-follow-button
                        user="{{ $article->author_id }}"
                    ></user-follow-button>
                    <user-message-button user="{{ $article->author_id }}" name="{{ $article->author->name }}"></user-message-button>
                </p>
            </div>
        </div>
    </div>
@endsection
