@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">登录</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">手机/邮箱</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus placeholder="11 位手机号 或 Email">

                                @if ($errors->has('username'))
                                    <span class="help-block mdui-text-color-pink">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('phone'))
                                    <span class="help-block mdui-text-color-pink">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('email'))
                                    <span class="help-block mdui-text-color-pink">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block mdui-text-color-pink">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住密码
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登录
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    忘记密码?
                                </a>

                                <a class="btn btn-link" href="{{ url('/register') }}">
                                    注册
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <login-card
    login="{{ route('login') }}"
    token="{{ csrf_token() }}"
    register="{{ url('/register') }}"
    password="{{ route('password.request') }}"
    ></login-card> -->
@endsection
