@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-3">
        <div class="mdui-card mdui-p-a-1 mdui-m-b-1 mdui-valign">
            <div class="mdui-center">
                <img src="{{ $user->avatar }}" class="mdui-img-fluid mdui-img-rounded  mdui-m-b-1 userAvatar" width="100" height="100">
                <upload-img-button url="{{ route('api.users.uploadAvatar', ['id' => $user->id]) }}" src="userAvatar"></upload-img-button>
            </div>
		</div>
        <div class="mdui-card mdui-p-a-1 mdui-m-b-1 mdui-valign">
            <div class="mdui-center">
                <img src="{{ array_has($user->settings, 'wechatCode') ? $user->settings['wechatCode'] : '' }}" class="mdui-img-fluid mdui-img-rounded  mdui-m-b-1 wechatCode" width="100" height="100">
                <upload-img-button url="{{ route('api.users.uploadWechatCode', ['id' => $user->id]) }}" src="wechatCode"></upload-img-button>
            </div>
		</div>
        <div class="mdui-card mdui-p-a-1 mdui-m-b-1 mdui-valign">
            <div class="mdui-center">
                <img src="{{ array_has($user->settings, 'alipayCode') ? $user->settings['alipayCode'] : '' }}" class="mdui-img-fluid mdui-img-rounded mdui-center mdui-m-b-1 alipayCode" width="100" height="100">
                <upload-img-button url="{{ route('api.users.uploadAlipayCode', ['id' => $user->id]) }}" src="alipayCode"></upload-img-button>
            </div>
		</div>

    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="mdui-m-b-2"><i class="fa fa-cog" aria-hidden="true"></i> 编辑个人资料</h3>
                <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="email" type="text" value="{{ $user->email }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="gender">
                                <option value="unselected">未选择</option>
                                <option value="male" @if($user->gender == 'male')selected @endif>男</option>
                                <option value="female" @if($user->gender == 'female')selected @endif>女</option>
                            </select>
                        </div>
                        <div class="col-sm-4 help-block">
        					@if ($errors->has('gender'))
        						<span class="mdui-text-color-theme-accent">
        							<strong>{{ $errors->first('gender') }}</strong>
        						</span>
        					@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">手机</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="phone" type="text" value="{{ $user->phone }}">
                        </div>
                        <div class="col-sm-4 help-block">
        					@if ($errors->has('phone'))
        						<span class="mdui-text-color-theme-accent">
        							<strong>{{ $errors->first('phone') }}</strong>
        						</span>
        					@else
        						如：name@website.com
        					@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                        </div>
                        <div class="col-sm-4 help-block">
        					@if ($errors->has('name'))
        						<span class="mdui-text-color-theme-accent">
        							<strong>{{ $errors->first('name') }}</strong>
        						</span>
        					@else
        						如：小明
        					@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">城市</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="city" type="text" value="{{ array_has($user->settings, 'city') ? $user->settings['city'] : ''}}">
                        </div>
                        <div class="col-sm-4 help-block">
        					@if ($errors->has('city'))
        						<span class="mdui-text-color-theme-accent">
        							<strong>{{ $errors->first('city') }}</strong>
        						</span>
        					@else
        						如：北京、广州
        					@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">微信</label>
                        <div class="col-sm-6">
                            <input class="form-control" name="wechat" type="text" value="{{ $user->wechat }}">
                        </div>
                        <div class="col-sm-4 help-block">
        					@if ($errors->has('wechat'))
        						<span class="mdui-text-color-theme-accent">
        							<strong>{{ $errors->first('wechat') }}</strong>
        						</span>
        					@else
        						如：simontuo
        					@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">个人简介</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" rows="3" name="bio" cols="50" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ array_has($user->settings, 'bio') ? $user->settings['bio'] : ''}}</textarea>
                        </div>
                        <div class="col-sm-4 help-block">
                            请一句话介绍你自己，大部分情况下会在你的头像和名字旁边显示
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <input class="mdui-btn mdui-color-theme-accent mdui-hoverable" type="submit" value="提交">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
