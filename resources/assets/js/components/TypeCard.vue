<template>
    <div class="mdui-m-y-5">
        <Card style="border-radius:6px">
            <div>
                <img :src="this.image" class="type-card-image mdui-shadow-1 mdui-hoverable mdui-m-l-2">
                <div class="pull-right mdui-m-r-2 type-card-title">
                    <span class="type-card-icons" mdui-tooltip="{content: '阅读量'}">
                        <Icon type="eye"></Icon>
                        {{ this.reads }}
                    </span>
                    <span class="type-card-icon" mdui-tooltip="{content: '总新建数'}">
                        <Icon type="ios-list"></Icon>
                        {{ this.count }}
                    </span>
                    <span class="type-card-icon" mdui-tooltip="{content: '评论数'}">
                        <Icon type="android-chat" ></Icon>
                        {{ this.comments }}
                    </span>
                    <span class="type-card-icon" mdui-tooltip="{content: '点赞数'}">
                        <Icon type="thumbsup"></Icon>
                        {{ this.likes }}
                    </span>
                    <h3 class="mdui-m-t-1">{{ this.type }}</h3>
                </div>
            </div>
            <div class="mdui-divider mdui-m-a-2 mdui-valign">
                <p class="mdui-m-t-4 mdui-center type-card-subtitle">为 Web 艺术家创造的 PHP 框架</p>
            </div>
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['type', 'image', 'reads', 'count', 'comments', 'likes']
    }
</script>

<style>
    .type-card-image {
        width: 100px;
        height: 100px;
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
        margin-bottom: 15px;
        font-size: 13px;
    }
    .type-card-subtitle {
        color: #BDCDDE;
        margin-bottom: 0;
        font-weight: 400;
    }
</style>
