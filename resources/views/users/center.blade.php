@extends('layouts.app')

@section('content')
    <div class="center-user-card col-md-3 mdui-m-b-2">
        <Card>
            <div class="mdui-valign mdui-m-y-2">
                <p class="mdui-center like-avatar"><img src="{{ $user->avatar }}" /></p>
            </div>
            <div class="mdui-valign mdui-m-t-2">
                <p class="mdui-center center-user-card-font">{{ $user->name }}</p>
            </div>
            <div class="mdui-valign mdui-m-b-2">
                <p class="mdui-center" style="line-height:25px;">
                    <span class="label label-info mdui-m-b-1">
                        <Icon type="{{ $user->gender == 'male' ? 'male' : 'female'}}"></Icon>
                    </span>
                    <span class="label label-info mdui-m-b-1">注册于{{ $user->created_at->diffForHumans() }}</span>
                    <span class="label label-info mdui-m-b-1">第 {{ $user->number() }} 会员</span>
                    <span class="label label-info mdui-m-t-1">活跃于{{ $user->updated_at->diffForHumans() }}</span>
                </p>
            </div>
            <div class="mdui-valign mdui-m-b-2">
                <p class="mdui-center mdui-text-color-theme"> <Icon type="android-bulb"></Icon> {{ isset($user->settings['bio']) ? $user->settings['bio'] : '未设置' }}</p>
            </div>
            <div class="mdui-divider mdui-m-b-2"></div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="mdui-valign mdui-m-b-1">
                        <p class="mdui-center center-user-card-font mdui-text-color-theme-accent">
                            {{ $user->followers_count }}
                        </p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="mdui-valign mdui-m-b-1">
                        <p class="mdui-center center-user-card-font mdui-text-color-theme-accent">
                            {{ $user->comments_count }}
                        </p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="mdui-valign mdui-m-b-1">
                        <p class="mdui-center center-user-card-font mdui-text-color-theme-accent">
                            {{ $user->articles_count + $user->calligraphies_count +  $user->answers_count  + $user->questions_count}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <div class="mdui-valign mdui-m-b-1">
                        <p class="mdui-center">
                            关注
                        </p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="mdui-valign mdui-m-b-1">
                        <p class="mdui-center">
                            评论
                        </p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="mdui-valign mdui-m-b-1">
                        <p class="mdui-center">
                            创作
                        </p>
                    </div>
                </div>
            </div>
            <div class="mdui-divider mdui-m-y-2"></div>

            <div class="mdui-valign mdui-m-y-4">
                <p class="mdui-center">
                    <user-follow-button
                        user="{{ $user->id }}"
                    ></user-follow-button>
                    <user-message-button user="{{ $user->id }}" name="{{ $user->name }}"></user-message-button>
                </p>
            </div>

            <!-- <div class="mdui-valign mdui-m-t-4">
                <p class="mdui-center">
                    <a href="#"><Icon type="ios-book"></Icon> 他发布的文章</a>
                </p>
            </div>

            <div class="mdui-divider mdui-m-y-1"></div>

            <div class="mdui-valign mdui-m-b-1">
                <p class="mdui-center">
                    <a href="#"><Icon type="chatbox-working"></Icon> 他发出的评论</a>
                </p>
            </div>

            <div class="mdui-divider mdui-m-y-1"></div>

            <div class="mdui-valign mdui-m-b-1">
                <p class="mdui-center">
                    <a href="#"><Icon type="plus-round"></Icon> 他关注的用户</a>
                </p>
            </div>

            <div class="mdui-divider mdui-m-y-1"></div>

            <div class="mdui-valign">
                <p class="mdui-center">
                    <a href="#"><Icon type="heart"></Icon> 他点赞的文章</a>
                </p>
            </div>
            <div class="mdui-divider mdui-m-t-1"></div> -->
        </Card>

    </div>

    <div class="col-md-9">
        <user-calligraphy-card user="{{ $user->id }}"></user-calligraphy-card>
        <user-article-card user="{{ $user->id }}"></user-article-card>
        <user-comment-card user="{{ $user->id }}"></user-comment-card>
        <!-- <user-center-tab user="{{ $user->id }}"></user-center-tab> -->
    </div>
@endsection
