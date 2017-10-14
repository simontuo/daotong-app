@extends('layouts.app')

@section('content')
    <div class="col-md-9">

        <navbar-menu
        calligraphy_url="{{ route('articles.index') }}"
        article_url="{{ route('articles.index') }}"
        question_url="{{ route('articles.index') }}"></navbar-menu>

        <article-list></article-list>
</div>
@endsection

@section('rightBar')
    <div class="col-md-3">
        
    </div>
@endsection
