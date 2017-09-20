@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <!-- 新增文章form -->
        <div class="panel panel-default">
            <div class="panel-heading">新增文章</div>
            <div class="panel-body">
                <form action="{{ route('articles.store') }}" method="post">
                    {{ csrf_field() }}

                    <cover cover="../avatars/1.jpg"></cover>







                    <div class="mdui-textfield">
                        <input class="mdui-textfield-input" type="title" placeholder="文章标题" maxlength="20"/>
                    </div>



                </form>
            </div>
        </div>
    </div>

    @include('layouts.rightBar')
</div>
@endsection
