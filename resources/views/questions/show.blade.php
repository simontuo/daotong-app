@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        <question-show data="{{ $question }}"></question-show>
    </div>
    <div class="col-md-3">
        <label-card></label-card>
    </div>
@endsection
