@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="row ivu-card ivu-card-bordered mdui-m-b-2">
            <div class="ivu-card-body">
                <form action="{{ route('articles.update', ['id' => $article->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <topics select="{{ $article->topics }}"></topics>

                    <div class="mdui-textfield">
                        <input name="title" class="mdui-textfield-input" type="title" placeholder="文章标题" maxlength="20" value="{{ $article->title }}"/>
                    </div>

                    <editor old_markdown_bio="{{ $article->markdown_bio }}"></editor>

                    <button class="mdui-btn mdui-color-theme mdui-m-t-1">提交</button>
                </form>
            </div>
        </div>
    </div>
@endsection
