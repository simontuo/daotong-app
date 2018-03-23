<div class="mdui-appbar mdui-appbar-fixed">
	<div class="mdui-toolbar mdui-color-theme">
		<a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer'}"><i class="mdui-icon material-icons">&#xe5d2;</i></a>
		<a href="{{ route('articles.index') }}" class="mdui-typo-headline">{{ config('app.name', 'Laravel') }}</a>
		<div class="mdui-toolbar-spacer"></div>
		@if(Auth::check())
			<a href="javascript:;" class="mdui-btn mdui-btn-icon mdui-text-color-theme-accent" mdui-menu="{target: '#add-attr'}"><i class="mdui-icon material-icons">&#xe145;</i></a>
	    	<ul class="mdui-menu " id="add-attr">
			    <li class="mdui-menu-item">
			        <a href="{{ url('/addArticle') }}" class="mdui-ripple">
			            <i class="mdui-menu-item-icon mdui-icon material-icons mdui-text-color-blue">&#xe150;</i>写些东西
			        </a>
			    </li>
			</ul>
	    	<button class="mdui-btn" mdui-menu="{target: '#user-attr'}"><i class="mdui-icon mdui-icon-right material-icons">&#xe5c5;</i>{{ Auth::user()->name }}</button>

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
	    	<a href="{{ url('/login') }}" class="mdui-btn mdui-btn mdui-color-pink"><i class="mdui-icon mdui-icon-right material-icons">&#xe890;</i> 登陆</a>
	    @endif
	</div>
</div>

<div class="mdui-drawer mdui-color-white" id="drawer" >
	<ul class="mdui-list" mdui-collapse="{accordion: true}">
		<li class="mdui-collapse-item" onclick="javascrtpt:window.location.href='{{ route('admin.users.index') }}'">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">&#xe7fb;</i>
				<div class="mdui-list-item-content">用户管理</div>
			</div>
		</li>
		<li class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-deep-orange">&#xe5c3;</i>
				<div class="mdui-list-item-content">资源管理</div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i>
			</div>
			<ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
				<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.articles.index') }}'">文章管理</li>
				<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.calligraphies.index') }}'">书法管理</li>
				<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.questions.index') }}'">问题管理</li>
				<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.answers.index') }}'">回答管理</li>
				<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.comments.index') }}'">评论管理</li>
				<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.messages.index') }}'">信息管理</li>
			</ul>
		</li>
		<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.mottoes.index') }}'">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-grey">&#xe865;</i>
			<div class="mdui-list-item-content">格言管理</div>
		</li>
		<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.suggestions.index') }}'">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-indigo">&#xe156;</i>
			<div class="mdui-list-item-content">建议管理</div>
		</li>
		<li class="mdui-subheader">Subheader</li>
		<li class="mdui-list-item mdui-ripple" onclick="javascrtpt:window.location.href='{{ route('admin.logs.index') }}'">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe241;</i>
			<div class="mdui-list-item-content">日志</div>
		</li>
		<li class="mdui-collapse-item" onclick="javascrtpt:window.location.href='{{ route('admin.settings.index') }}'">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-cyan">&#xe8b8;</i>
				<div class="mdui-list-item-content">设置</div>
				<!-- <i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i> -->
			</div>
			<!-- <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
				<li class="mdui-list-item mdui-ripple">主题设置</li>
				<li class="mdui-list-item mdui-ripple">常规设置</li>
			</ul> -->
		</li>
		<li class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-pink">&#xe872;</i>
			<div class="mdui-list-item-content">公告</div>
		</li>
		<li class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">&#xe000;</i>
			<div class="mdui-list-item-content">统计</div>
		</li>
	</ul>
</div>
