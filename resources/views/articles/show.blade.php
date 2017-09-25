@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-9">
        <div class="markdown-body code-github">
            {!! $article->text($article->bio) !!}
        </div>
    </div>

    @include('layouts.rightBar')
</div>
@endsection
