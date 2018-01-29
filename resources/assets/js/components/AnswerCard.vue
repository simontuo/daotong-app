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
        <Button type="primary" size="small" icon="arrow-up-b" class="question-button" @click="like">
            <small>{{ model.likes.length }}</small>
        </Button>
        <Button type="primary" size="small" icon="arrow-down-b" class="question-button" @click="dislike">
            <small>{{ model.dislikes.length }}</small>
        </Button>
        <ButtonGroup style="margin-left: -15px;" class="mdui-hidden-sm-up">
            <Button type="text"  class="question-button question-button-color" icon="chatbubble" @click="showComment = showComment ? false:true"><strong>{{ model.comments_count }} 条评论</strong></Button>
            <Button type="text"  class="question-button question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
            <Button type="text"  class="question-button question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
         </ButtonGroup>
        <ButtonGroup class="mdui-hidden-xs-down">
            <Button type="text"  class="question-button question-button-color" icon="chatbubble" @click="showComment = showComment ? false:true"><strong>{{ model.comments_count }} 条评论</strong></Button>
            <Button type="text"  class="question-button question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
            <Button type="text"  class="question-button question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
        </ButtonGroup>

        <comment-card v-if="showComment" :model="this.model.id" type="Answer"></comment-card>

    </Card>

</template>

<script>
    export default {
        props: ['model', 'userInfo'],
        data() {
            return {
                showComment: false,
            }
        },
        mounted() {

        },
        methods: {
            like() {
                axios.post('/api/likes/store', {'type': 'Answer', 'id': this.model.id}).then(response => {
                    if (!response.data.status) {
                        if (response.data.message) {
                            this.$Message.info({content: response.data.message, duration: 5});
                        }else {
                            this.$Message.error({content: '点赞失败！', duration: 5});
                        }
                    }else{
                        this.$emit('child-say', response.data);
                        this.$Message.success({content: '点赞成功！', duration: 2});
                    }
                }).catch(error => {
                    this.$Notice.info({
                        title: error.response.status,
                        desc: error.response.data.message,
                        duration: 2
                    });
                });
            },
            dislike() {
                axios.post('/api/likes/dislikeStore', {'type': 'Answer', 'id': this.model.id}).then(response => {
                    if (!response.data.status) {
                        if (response.data.message) {
                            this.$Message.info({content: response.data.message, duration: 5});
                        }else {
                            this.$Message.error({content: '不赞同失败！', duration: 5});
                        }
                    }else{
                        this.$emit('child-say', response.data);
                        this.$Message.success({content: '不赞同成功！', duration: 2});
                    }
                }).catch(error => {
                    this.$Notice.info({
                        title: error.response.status,
                        desc: error.response.data.message,
                        duration: 2
                    });
                });
            }
        }
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
