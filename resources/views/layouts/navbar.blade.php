<div class="mdui-appbar mdui-color-indigo-a200 mdui-appbar-fixed">
    <div class="mdui-container">
        <div class="mdui-toolbar">
            @if(Auth::check())
                <a href="javascript:;" class="mdui-btn mdui-btn-icon mdui-hidden-md-up" mdui-drawer="{target: '#left-drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></a>
            @endif
            <a href="{{ route('index') }}" class="mdui-typo-title">{{ config('app.name', 'Laravel') }}</a>
            <div class="mdui-toolbar-spacer"></div>
            @if(Auth::check())
                <a href="javascript:;" class="hidden-xs hidden-sm mdui-btn mdui-btn-icon" mdui-menu="{target: '#add-attr'}"><i class="mdui-icon material-icons">&#xe145;</i></a>
                <ul class="mdui-menu " id="add-attr">
                    <li class="mdui-menu-item">
                        <a href="{{ route('calligraphies.create') }}" class="mdui-ripple">
                            <i class="mdui-menu-item-icon mdui-icon material-icons mdui-text-color-green">&#xe6dd;</i>发布书法
                        </a>
                    </li>
                    <li class="mdui-menu-item">
                        <a href="{{ route('articles.create') }}" class="mdui-ripple">
                            <i class="mdui-menu-item-icon mdui-icon material-icons mdui-text-color-indigo">&#xe865;</i>发布文章
                        </a>
                    </li>
                    <li class="mdui-menu-item">
                        <a href="{{ route('questions.create') }}" class="mdui-ripple">
                            <i class="mdui-menu-item-icon mdui-icon material-icons mdui-text-color-red">&#xe887;</i>发布问题
                        </a>
                    </li>
                </ul>

                <suggestion-button></suggestion-button>

                <badge url="{{ route('inboxs.index', ['id' => Auth::id()]) }}" user="{{ Auth::id() }}"></badge>

                <button class="mdui-btn hidden-xs hidden-sm" mdui-menu="{target: '#user-attr'}">
                    <img class="mdui-img-circle mdui-icon-left userAvatar" src="{{ user()->avatar }}" id="user-avatar"/>
                    <i class="mdui-icon mdui-icon-right material-icons">&#xe5c5;</i>
                    {{ Auth::user()->name }}
                </button>

	        	<ul class="mdui-menu " id="user-attr">
                    <li class="mdui-menu-item">
				        <a href="{{ route('users.center', user()->id) }}" class="mdui-ripple">
				            <i class="mdui-menu-item-icon mdui-icon material-icons">&#xe853;</i>个人中心
				        </a>
				    </li>
				    <li class="mdui-menu-item">
				        <a href="{{ route('users.edit', user()->id) }}" class="mdui-ripple">
				            <i class="mdui-menu-item-icon mdui-icon material-icons">&#xe8b8;</i>编辑资料
				        </a>
				    </li>
                    <li class="mdui-menu-item">
				        <a href="{{ route('users.edit_password', user()->id) }}" class="mdui-ripple">
				            <i class="mdui-menu-item-icon mdui-icon material-icons">&#xe898;</i>修改密码
				        </a>
				    </li>
                    @can('viewAdmin', user())
                    <li class="mdui-menu-item">
				        <a href="{{ route('admin.home.index') }}" class="mdui-ripple">
				            <i class="mdui-menu-item-icon mdui-icon material-icons">&#xe85e;</i>后台管理
				        </a>
				    </li>
                    @endcan
				    <li class="mdui-divider"></li>
				    <li class="mdui-menu-item"
						onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
				        <a href="javascript:;" class="mdui-ripple">
				            <i class="mdui-menu-item-icon mdui-icon material-icons">&#xe566;</i>退出
				            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                    {{ csrf_field() }}
			                </form>
				        </a>
				    </li>
				</ul>
	        @else
            <suggestion-button></suggestion-button>
            <a href="{{ url('/login') }}" class="mdui-btn mdui-color-theme-accent mdui-ripple">
                <i class="mdui-icon mdui-icon-right material-icons">&#xe890;</i>登录
            </a>
            @endif
        </div>
    </div>
</div>
@if(Auth::check())
    <div class="mdui-drawer mdui-drawer-close mdui-color-white" id="left-drawer">
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple mdui-center">
                <div class="mdui-valign">
                    <p class="mdui-center like-avatar"><img src="{{ user()->avatar }}" /></p>
                </div>
                <div class="mdui-valign mdui-m-y-1">
                    <p class="mdui-center mdui-typo-title">{{ user()->name }}</p>
                </div>
            </li>
            <li class="mdui-subheader">发布内容</li>
            <a href="{{ route('calligraphies.create') }}" class="mdui-ripple">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-green">&#xe6dd;</i>
                    <div class="mdui-list-item-content">发布书法</div>
                </li>
            </a>
            <a href="{{ route('articles.create') }}" class="mdui-ripple">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-indigo">&#xe865;</i>
                    <div class="mdui-list-item-content">发布文章</div>
                </li>
            </a>
            <a href="{{ route('questions.create') }}" class="mdui-ripple">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-red">&#xe887;</i>
                    <div class="mdui-list-item-content">发布问题</div>
                </li>
            </a>

            <li class="mdui-subheader">个人中心</li>
            <a href="{{ route('users.center', user()->id) }}" class="mdui-ripple">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-yellow">&#xe853;</i>
                    <div class="mdui-list-item-content">个人中心</div>
                </li>
            </a>
            <a href="{{ route('users.edit', user()->id) }}" class="mdui-ripple">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-teal">&#xe8b8;</i>
                    <div class="mdui-list-item-content">编辑资料</div>
                </li>
            </a>
            <a href="{{ route('users.edit_password', user()->id) }}" class="mdui-ripple">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-purple">&#xe898;</i>
                    <div class="mdui-list-item-content">修改密码</div>
                </li>
            </a>
            @can('viewAdmin', user())
            <a href="{{ route('admin.home.index') }}" class="mdui-ripple">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue-grey">&#xe85e;</i>
                    <div class="mdui-list-item-content">后台管理</div>
                </li>
            </a>
            @endcan
            <a href="javascript:;" class="mdui-ripple" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe566;</i>
                    <div class="mdui-list-item-content">退出</div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </a>
        </ul>
    </div>
@endif
