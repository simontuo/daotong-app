<template>
    <div class="mdui-m-y-3">
        <Card style="border-radius:6px">
            <div>
                <img :src="this.image" class="type-card-image mdui-shadow-1 mdui-hoverable">
                <div class="pull-right type-card-title ">
                    <p class="type-card-icon">
                        {{ this.createdTime }}
                    </p>
                </div>
                <p class="mdui-m-y-2 type-card-subtitle mdui-text-truncate">{{ this.title }}</p>
                <div class="type-card-footer">
                    <span class="type-card-icon pull-left">
                        <Icon type="heart" class="mdui-text-color-theme-accent"></Icon>
                    </span>
                    <span class="type-card-icon pull-right" mdui-tooltip="{content: '评论数'}">
                        <Icon type="android-chat"></Icon>
                        {{ this.commentsCount }}
                    </span>
                    <span class="type-card-icon pull-right mdui-m-r-1" mdui-tooltip="{content: '点赞数'}">
                        <Icon type="thumbsup"></Icon>
                        {{ this.likesCount }}
                    </span>
                    <span class="type-card-icon pull-right mdui-m-r-1" mdui-tooltip="{content: '阅读量'}">
                        <Icon type="eye"></Icon>
                        {{ this.readsCount }}
                    </span>
                </div>
            </div>
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['title', 'image', 'createdTime', 'readsCount', 'commentsCount', 'likesCount']
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
