@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <!-- 新增文章form -->
        <alert></alert>
        <form action="{{ route('articles.store') }}" method="post">
            {{ csrf_field() }}

            <cover api_token="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}"></cover>

            <div class="mdui-textfield">
                <input name="title" class="mdui-textfield-input" type="title" placeholder="文章标题" maxlength="20"/>
            </div>

            <editor></editor>

            <button class="mdui-btn mdui-color-theme">submit</button>
        </form>
    </div>

    @include('layouts.rightBar')
</div>
@endsection
