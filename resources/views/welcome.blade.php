@extends('layouts.app')

@section('content')
    <div class="col-md-9">

        <navbar-menu
        calligraphy_url="{{ route('calligraphys.index') }}"
        article_url="{{ route('articles.index') }}"
        question_url="{{ route('articles.index') }}"></navbar-menu>

        <article-list class="mdui-m-b-2"></article-list>
</div>
@endsection

@section('rightBar')
    <div class="col-md-3">
        <ranking-list type="articles"></ranking-list>
    </div>
@endsection




@extends('layouts.app')

@section('content')
    <div class="col-md-9">

        <navbar-menu
        calligraphy_url="{{ route('articles.index') }}"
        article_url="{{ route('articles.index') }}"
        question_url="{{ route('articles.index') }}"></navbar-menu>

        <calligraphy-list></calligraphy-list>
</div>
@endsection

@section('rightBar')
    <div class="col-md-3">
        <ranking-list type="calligraphys"></ranking-list>
    </div>
@endsection
