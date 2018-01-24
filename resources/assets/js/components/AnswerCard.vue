<template>
    <Card>
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <Avatar size="large" :src="userInfo.avatar" />
                </a>
            </div>
            <div class="media-body">
                <div class="" style="max-width: 90%;">
                    <h4 class="media-heading mdui-text-capitalize">{{ userInfo.name }}</h4>
                    <p class="mdui-text-truncate" >{{ userInfo.settings.bio }}</p>
                </div>
            </div>
        </div>
        <p class="mdui-typo mdui-center mdui-typo-subheading"> <a href="#" class="mdui-text-color-blue-900"><small>查看全部 25 个回答</small></a></p>
        <div class="markdown-body code-github mdui-m-y-1" v-html="model.bio">
        </div>
        <Button type="primary" size="small" icon="arrow-up-b" class="question-button">
            <small>1234</small>
        </Button>
        <Button type="primary" size="small" icon="arrow-down-b" class="question-button">
        </Button>
        <ButtonGroup>
            <Button type="text"  class="question-button question-button-color" icon="chatbubble"><strong>25 条评论</strong></Button>
            <Button type="text"  class="question-button question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
            <Button type="text"  class="question-button question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
         </ButtonGroup>
    </Card>

</template>

<script>
    export default {
        props: ['model', 'userInfo'],
    }
</script>

<style>
    .question-button {
        font-size: 15px;
    }
    .question-button-color {
        color: #8590a6;
    }
</style>
