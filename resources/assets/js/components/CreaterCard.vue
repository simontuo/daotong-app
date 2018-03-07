<template>
    <Card style="text-align:center">
        <p slot="title">作者信息</p>
        <div class="mdui-valign">
            <p class="mdui-center like-avatar"><img :src="creater.avatar" /></p>
        </div>
        <div class="mdui-valign mdui-m-y-2">
            <p class="mdui-center"><span class="label label-success">{{ creater.name }}</span></p>
        </div>
        <div class="mdui-valign mdui-m-b-2">
            <p class="mdui-center">
                <span>已关注：{{ creater.followers_count }}</span>
                <span>被关注：{{ creater.followings_count  }}</span>
                <span>文章：{{ creater.articles_count }}</span>
                <span>评论：{{ creater.comments_count }}</span>
            </p>
        </div>
        <div class="mdui-valign mdui-m-b-2">
            <p class="mdui-center">
                <user-follow-button
                    :user="creater.id"
                ></user-follow-button>
                <user-message-button :user="creater.id" :name="creater.name"></user-message-button>
            </p>
        </div>
    </Card>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                creater: JSON.parse(this.user)
            }
        }
    }
</script>
<style>
    .like-avatar{
        background-color: #fff;
        border: 1px solid #ddd;
        width: 60px;
        height: 60px;
        border-radius: 60px;
    }
    .like-avatar img{
        margin: 4px;
        width: 50px;
        height: 50px;
        border-radius: 50px;
    }
</style>
