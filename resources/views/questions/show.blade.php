@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <div class="row">
            <question-show data="{{ $question }}" token="{{ csrf_token() }}" user="{{ $question->user }}"></question-show>
        </div>

    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="mdui-m-b-2">
                <creater-card
                    user="{{ $question->user }}"
                ></creater-card>
            </div>
            <hot-calligraphy-card></hot-calligraphy-card>
        </div>
    </div>

@endsection
