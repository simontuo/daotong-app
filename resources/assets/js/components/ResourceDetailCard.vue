<template >
    <Card style="min-height: 230px;">
        <div class="mdui-m-b-1">
            <span class="ivu-tag-dot-inner mdui-color-pink" style="margin-right:0"></span>
            <span class="mdui-m-r-1">文章 {{ detail.article }}</span>
            <span class="ivu-tag-dot-inner mdui-color-blue" style="margin-right:0"></span>
            <span class="mdui-m-r-1">书法 {{ detail.calligraphy }}</span>
            <span class="ivu-tag-dot-inner mdui-color-green" style="margin-right:0"></span>
            <span class="mdui-m-r-1">问题 {{ detail.question }}</span>
            <span class="ivu-tag-dot-inner mdui-color-yellow" style="margin-right:0"></span>
            <span class="mdui-m-r-1">回答 {{ detail.answer }}</span>
            <span class="ivu-tag-dot-inner mdui-color-orange" style="margin-right:0"></span>
            <span class="mdui-m-r-1">评论 {{ detail.comment }}</span>
            <span class="ivu-tag-dot-inner mdui-color-cyan" style="margin-right:0"></span>
            <span class="mdui-m-r-1">点赞 {{ detail.like }}</span>
            <span class="ivu-tag-dot-inner mdui-color-brown" style="margin-right:0"></span>
            <span class="mdui-m-r-1">私信 {{ detail.message }}</span>
            <span class="ivu-tag-dot-inner mdui-color-purple" style="margin-right:0"></span>
            <span class="mdui-m-r-1">标签 {{ detail.topic }}</span>
        </div>

        <Progress :percent="(detail.article / detail.total).toFixed(2) * 100"  :stroke-width="13" class="pink"></Progress>
        <Progress :percent="(detail.calligraphy / detail.total).toFixed(2) * 100"  :stroke-width="13" class="blue"></Progress>
        <Progress :percent="(detail.question / detail.total).toFixed(2) * 100"  :stroke-width="13" class="green"></Progress>
        <Progress :percent="(detail.answer / detail.total).toFixed(2) * 100"  :stroke-width="13" class="yellow"></Progress>
        <Progress :percent="(detail.comment / detail.total).toFixed(2) * 100"  :stroke-width="13" class="orange"></Progress>
        <Progress :percent="(detail.like / detail.total).toFixed(2) * 100"  :stroke-width="13" class="cyan"></Progress>
        <Progress :percent="(detail.message / detail.total).toFixed(2) * 100"  :stroke-width="13" class="brown"></Progress>
        <Progress :percent="(detail.topic / detail.total).toFixed(2) * 100"  :stroke-width="13" class="purple"></Progress>
    </Card>
</template>

<script>
    export default {
        data() {
            return {
                detail: [],
            }
        },
        mounted() {
            axios.get('/api/statistics/resourceDetail').then(response => {
                this.detail = response.data.detail;
            });
        }
    }
</script>

<style>
    .pink .ivu-progress-bg {
        background-color: #e91e63;
    }
    .blue .ivu-progress-bg {
        background-color: #2196f3;
    }
    .green .ivu-progress-bg {
        background-color: #4caf50;
    }
    .yellow .ivu-progress-bg {
        background-color: #ffeb3b;
    }
    .orange .ivu-progress-bg {
        background-color: #ff9800;
    }
    .cyan .ivu-progress-bg {
        background-color: #00bcd4;
    }
    .brown .ivu-progress-bg {
        background-color: #795548;
    }
    .purple .ivu-progress-bg {
        background-color: #9c27b0;
    }
</style>
