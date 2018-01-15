@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <a href="{{ route('calligraphys.index') }}">
            <type-card
                type="书法"
                image="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1510857579050&di=acbfd429f8b2504906d1ceb2eee1d142&imgtype=0&src=http%3A%2F%2Fimg.25pp.com%2Fuploadfile%2Fapp%2Ficon%2F20150903%2F1441210152866249.png"
                reads="{{ $calligraphysReadsTotal }}"
                count="{{ $calligraphysCount }}"
                comments="{{ $calligraphysCommentsCount }}"
                likes="{{ $calligraphysLikesCount }}">
            </type-card>
        </a>

    </div>
    <div class="col-md-4">
        <a href="{{ route('articles.index') }}">
            <type-card
                type="文章"
                image="http://www.logomr.com/logomrdata/2017/11/06/f16e1002-fd9f-4558-8f3e-96911a901e8f.png"
                reads="{{ $articlesReadsTotal }}"
                count="{{ $articlesCount }}"
                comments="{{ $articlesCommentsCount }}"
                likes="{{ $articlesLikesCount }}">
            </type-card>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('questions.index') }}">
            <type-card
                type="问道"
                image="http://www.logomr.com/logomrdata/2017/11/02/fb2d36f9c22fc7b164462919afd0d37a.svg"
                reads="1"
                count="0"
                comments="0"
                likes="0">
            </type-card>
        </a>
    </div>
    <div class="col-md-4">
        <type-card
            type="读后感"
            image="http://www.logomr.com/logomrdata/2017/11/01/f2a592981ce5a55fd2aa8251f37219f4.svg"
            reads="1"
            count="0"
            comments="0"
            likes="0">
        </type-card>
    </div>
    <div class="col-md-4">
        <type-card
            type="推荐"
            image="http://www.logomr.com/logomrdata/2017/10/28/da7594ae6c0cc899d8a5c3475e3c0289.svg"
            reads="1"
            count="0"
            comments="0"
            likes="0">
        </type-card>
    </div>
    <div class="col-md-4">
        <type-card
            type="收藏"
            image="http://www.logomr.com/logomrdata/2017/11/07/59d7ad03-f3d6-41e5-970f-4c7bb495cab3.png"
            reads="1"
            count="0"
            comments="0"
            likes="0">
        </type-card>
    </div>
</div>




@endsection
