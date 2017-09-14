<div class="mdui-appbar mdui-color-theme mdui-appbar-fixed">
    <div class="mdui-container">
        <div class="mdui-toolbar">
            <a href="javascript:;" class="mdui-typo-title">{{ config('app.name', 'Laravel') }}</a>
            <div class="mdui-toolbar-spacer"></div>
            @if(Auth::check())

	        	<button class="mdui-btn hidden-xs hidden-sm" mdui-menu="{target: '#user-attr'}">
                    <img class="mdui-img-circle mdui-icon-left" src="{{ user()->avatar }}" />
                    <i class="mdui-icon mdui-icon-right material-icons">&#xe5c5;</i>
                    {{ Auth::user()->name }}
                </button>
	        	<ul class="mdui-menu " id="user-attr">
				    <li class="mdui-menu-item">
				        <a href="{{ route('users.edit', user()->id) }}" class="mdui-ripple">
				            <i class="mdui-menu-item-icon mdui-icon material-icons">&#xe3c9;</i>编辑资料
				        </a>
				    </li>
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
            <a href="{{ url('/login') }}" class="mdui-btn mdui-color-theme-accent mdui-ripple">
                <i class="mdui-icon mdui-icon-right material-icons">&#xe890;</i>登录
            </a>
            @endif
        </div>
    </div>
</div>
