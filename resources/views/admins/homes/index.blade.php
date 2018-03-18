@extends('layouts.admins.app')

@section('content')

<div class="row">
    <div class="col-md-3 mdui-m-b-2">
        <total-card type="user" describe="用户量"></total-card>
    </div>
    <div class="col-md-3 mdui-m-b-2">
        <total-card type="resource" describe="资源量"></total-card>
    </div>
    <div class="col-md-3 mdui-m-b-2">
        <total-card type="visit" describe="访问量"></total-card>
    </div>
    <div class="col-md-3 mdui-m-b-2">
        <Card>
            <p style="text-align:center" class="mdui-typo-display-1 mdui-text-color-pink">
                1,000
            </p>
            <p style="text-align:center" class="mdui-typo-headline">
                报错量
            </p>
        </Card>
    </div>

    <div class="col-md-6 mdui-m-b-2">
        <user-detail-card></user-detail-card>
    </div>
    <div class="col-md-6 mdui-m-b-2">
        <resource-detail-card></resource-detail-card>
    </div>
    <div class="col-md-6 mdui-m-b-2">
        <visit-detail-card></visit-detail-card>
    </div>
    <div class="col-md-6 mdui-m-b-2">
        <error-detail-card></error-detail-card>
    </div>
</div>

@endsection
