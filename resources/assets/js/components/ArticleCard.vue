<template>
    <div class="mdui-m-y-3">
        <Card style="border-radius:6px">
            <div>
                <img :src="this.user.avatar" class="type-card-image mdui-shadow-1 mdui-hoverable">
                <div class="pull-right type-card-title">
                    {{ this.user.name }}
                    <span class="type-card-icon">
                        创建于：{{ this.createdTime }}
                    </span>
                </div>
                <div class="article-card-topic">
                    <span  v-for="item in topics">
                        <Tag checkable color="blue" size="small">{{ item.name }}</Tag>
                    </span>
                    <span  v-if="topics.length == 0">
                        <Tag checkable color="yellow" size="small">无Topic</Tag>
                    </span>
                </div>
                <p class="mdui-m-b-1 type-card-subtitle mdui-text-truncate">{{ this.title }}</p>
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
        props: ['title', 'user', 'createdTime', 'readsCount', 'commentsCount', 'likesCount', 'topics']
    }
</script>

<style>
    .type-card-image {
        width: 50px;
        height: 50px;
        margin: -40px 20px 0 0;
        border-radius: 6px;
        text-align: center;
    }
    .type-card-title {
        text-align: end;
        margin-top: -5px;
    }
    .type-card-icon {
        color: #BDCDDE;
        margin-bottom: 0;
        margin-top: -5px;
        font-size: 13px;
    }
    .type-card-subtitle {
        color: #BDCDDE;
        margin-bottom: 0;
        font-weight: 400;
        font-size: 18px;
        text-align: center;
    }
    .type-card-footer {
        padding: 0px 0px 10px;
    }

    .article-card-topic{
        height: 34px;
        overflow: scroll;
    }
</style>
