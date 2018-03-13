@extends('layouts.admins.app')

@section('content')

    <div class="col-md-9">
        <div class="row ivu-card ivu-card-bordered mdui-m-b-2 ">
            <div class="ivu-card-body mdui-color-white">
                <!-- bio -->
                <div class="markdown-body code-github mdui-m-b-2">
                    {!! $suggestion->bio !!}

                </div>
            </div>
        </div>
    </div>




@endsection
