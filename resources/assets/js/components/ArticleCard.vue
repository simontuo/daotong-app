<template>
    <div class="mdui-m-y-3">
        <Card style="border-radius:6px">
            <div>
                <img :src="this.image" class="type-card-image mdui-shadow-1 mdui-hoverable">
                <p class="mdui-m-y-2 type-card-subtitle mdui-text-truncate">为 Web 艺术家创造的 PHP 框架</p>
                <div class="type-card-footer">
                    <span class="type-card-icon pull-left">
                        <Icon type="android-people"></Icon>
                        12
                    </span>
                    <span class="type-card-icon pull-right">
                        <Icon type="ios-list"></Icon>
                        50
                    </span>
                </div>
            </div>
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['type', 'image']
    }
</script>

<style>
    .type-card-image {
        width: 50px;
        height: 50px;
        margin: -40px 20px 0 0;
        border-radius: 3px;
        text-align: center;
    }
    .type-card-title {
        text-align: end;
    }
    .type-card-icon {
        color: #BDCDDE;
        margin-bottom: 0;
        margin-top: -5px;
        /*margin-bottom: 15px;*/
        font-size: 13px;
    }
    .type-card-subtitle {
        color: #BDCDDE;
        margin-bottom: 0;
        font-weight: 400;
    }
    .type-card-footer {
        padding: 0px 0px 10px;
    }
</style>
