@extends('layouts.app')

@section('content')
<div class="col-md-1 mdui-m-y-3 mdui-valign">

</div>
<div class="col-md-10">
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-3">
                <a href="{{ route('articles.show', [ 'id' => $article->id ]) }}">
                    <article-card
                    image="{{ $article->user->avatar }}"
                    title="{{ $article->title }}"
                    ></article-card>
                </a>
            </div>
        @endforeach


    </div>
</div>

@endsection
