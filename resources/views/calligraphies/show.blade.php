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
                    <h2 class="mdui-m-b-1">{{ $calligraphy->title }}</h2>
                    <div  style="font-size:13px;text-align: center;">
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe192;</i> {{ $calligraphy->created_at->diffForHumans() }} -
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe417;</i> {{ $calligraphy->reads_count }} -
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe8dc;</i> {{ $calligraphy->likes()->count() }} -
        				<i class="mdui-icon mdui-icon-right material-icons" style="font-size:13px;">&#xe0b7;</i> {{ $calligraphy->comments_count }}
        			</div>
                </div>
                <!-- bio -->
                <div class="markdown-body code-github mdui-m-b-2">
                    <div class="mdui-m-b-1 mdui-valign">
                        <ul class="mdui-center">
                            @foreach($calligraphy->images as $image)
                                <li class="mdui-m-b-1 "><img src="{{ $image }}" class="mdui-img-fluid mdui-img-rounded mdui-hoverable mdui-shadow-1 mdui-center"></li>
                            @endforeach
                        </ul>
                    </div>
                    <blockquote>
                        <p>{{ $calligraphy->bio }}</p>
                    </blockquote>
                </div>
            </div>
        </div>
        <!-- like-card -->
        <div class="row mdui-m-b-2">
            <!-- like-card -->
            <like-card model="{{ $calligraphy->id }}" type="Calligraphy"></like-card>
        </div>
        <!-- comment-list -->
        <div class="row mdui-m-b-2">
            <!-- comment-->
            <comment-list title="{{ $calligraphy->title }}" model="{{ $calligraphy->id }}" type="Calligraphy"></comment-list>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="mdui-m-b-2">
                <creater-card
                    user="{{ $calligraphy->user }}"
                ></creater-card>
            </div>
            <hot-calligraphy-card></hot-calligraphy-card>
        </div>
    </div>
@endsection
