<div class="mdui-appbar mdui-color-indigo-a200 mdui-appbar-fixed">
    <div class="mdui-container">
        <div class="mdui-toolbar">
            <a href="{{ route('index') }}" class="mdui-typo-title">{{ config('app.name', 'Laravel') }}</a>
            <div class="mdui-toolbar-spacer"></div>
            <!-- <search-input></search-input> -->
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
