@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <!-- 新增文章form -->
        
        <form action="{{ route('articles.store') }}" method="post">
            {{ csrf_field() }}
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> Better check yourself, you're not looking too good.
            </div>
            <cover cover="../avatars/1.jpg"></cover>

            <div class="mdui-textfield mdui-m-b-1">
                <input class="mdui-textfield-input" type="title" placeholder="文章标题" />
            </div>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> Better check yourself, you're not looking too good.
            </div>

            <editor1></editor1>

            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">Button</button>
        </form>
            
    </div>

    @include('layouts.rightBar')
</div>
@endsection
