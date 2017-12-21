@extends('layouts.admins.app')

@section('content')

<div>
    <bread-crumb
        url1="{{ route('index') }}"
        url2="{{ route('admin.home.index') }}"
        url3="{{ route('admin.articles.index') }}"
    ></bread-crumb>
    <article-table></article-table>
</div>
@endsection
