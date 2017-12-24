@if(Auth::check() && !user()->isActive())
    <div class="alert alert-warning mdui-valign" role="alert">
        <span class="mdui-center"><strong>注意!</strong> 你的账号处于还没激活状态，请尽快登录注册邮箱：{{ user()->email }} 进行激活！</span>
    </div>
@endif
