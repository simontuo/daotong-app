<template >
    <Card>
        <div class="mdui-m-b-1">
            <span class="ivu-tag-dot-inner mdui-color-pink" style="margin-right:0"></span>
            <span class="mdui-m-r-1">文章</span>
            <span class="ivu-tag-dot-inner mdui-color-blue" style="margin-right:0"></span>
            <span class="mdui-m-r-1">书法</span>
            <span class="ivu-tag-dot-inner mdui-color-green" style="margin-right:0"></span>
            <span class="mdui-m-r-1">问题</span>
            <span class="ivu-tag-dot-inner mdui-color-yellow" style="margin-right:0"></span>
            <span class="mdui-m-r-1">回答</span>
            <span class="ivu-tag-dot-inner mdui-color-orange" style="margin-right:0"></span>
            <span class="mdui-m-r-1">评论</span>
            <span class="ivu-tag-dot-inner mdui-color-cyan" style="margin-right:0"></span>
            <span class="mdui-m-r-1">点赞</span>
            <span class="ivu-tag-dot-inner mdui-color-brown" style="margin-right:0"></span>
            <span class="mdui-m-r-1">私信</span>
            <span class="ivu-tag-dot-inner mdui-color-purple" style="margin-right:0"></span>
            <span class="mdui-m-r-1">标签</span>
        </div>


        <Progress :percent="12"  :stroke-width="13" class="pink"></Progress>
        <Progress :percent="33"  :stroke-width="13" class="blue"></Progress>
        <Progress :percent="25"  :stroke-width="13" class="green"></Progress>
        <Progress :percent="17"  :stroke-width="13" class="yellow"></Progress>
        <Progress :percent="21"  :stroke-width="13" class="orange"></Progress>
        <Progress :percent="70"  :stroke-width="13" class="cyan"></Progress>
        <Progress :percent="88"  :stroke-width="13" class="brown"></Progress>
        <Progress :percent="44"  :stroke-width="13" class="purple"></Progress>
    </Card>
</template>

<script>
    export default {

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
