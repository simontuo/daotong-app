@extends('layouts.admins.app')

@section('content')

<div class="row">
    <div class="col-md-3 mdui-m-b-2">
        <Card>
            <p style="text-align:center" class="mdui-typo-display-1 mdui-text-color-pink">
                 1,000
            </p>
            <p style="text-align:center" class="mdui-typo-headline">
                用户量
            </p>
        </Card>
    </div>
    <div class="col-md-3 mdui-m-b-2">
        <Card>
            <p style="text-align:center" class="mdui-typo-display-1 mdui-text-color-pink">
                 1,203
            </p>
            <p style="text-align:center" class="mdui-typo-headline">
                资源量
            </p>
        </Card>
    </div>
    <div class="col-md-3 mdui-m-b-2">
        <Card>
            <p style="text-align:center" class="mdui-typo-display-1 mdui-text-color-pink">
                1,000
            </p>
            <p style="text-align:center" class="mdui-typo-headline">
                访问量
            </p>
        </Card>
    </div>
    <div class="col-md-3 mdui-m-b-2">
        <Card>
            <p style="text-align:center" class="mdui-typo-display-1 mdui-text-color-pink">
                1,000
            </p>
            <p style="text-align:center" class="mdui-typo-headline">
                用户数量
            </p>
        </Card>
    </div>

    <div class="col-md-12">
        <resource-detail-card></resource-detail-card>
    </div>
</div>

@endsection
