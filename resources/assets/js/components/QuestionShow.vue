<template>
    <div>
        <Card>
            <span v-for="item in question.topics">
                <Tag class="question-tag" >{{ item.name }}</Tag>
            </span>

            <Tag class="question-tag" v-if="question.topics.length == 0">没有对应的topic</Tag>
            <div class="mdui-typo-title"><strong>{{ question.title }}</strong></div>
            <div class="mdui-typo-subheading mdui-m-y-1">{{ question.bio }}</div>
            <question-follow-button :model="question.id"></question-follow-button>
            <Button type="ghost" class="question-button" icon="edit" @click="answerShow = answerShow ? false:true"><strong>回答问题</strong></Button>
            <ButtonGroup>
                <Button type="text"  class="question-button question-button-color" icon="chatbubble" @click="commentShow = commentShow ? false:true"><strong>{{ question.comments_count }} 条评论</strong></Button>
                <Button type="text"  class="question-button question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
                <Button type="text"  class="question-button question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
            </ButtonGroup>

            <div class="mdui-m-t-2 mdui-shadow-1" v-if="commentShow">
                <comment-card :model="question.id" type="Question"></comment-card>
            </div>


        </Card>
        <Card class="mdui-m-y-1" v-if="!answerShow">
            <div class=" mdui-valign">
                <p v-if="answers.length > 0" class="mdui-typo mdui-center mdui-typo-subheading"> <a href="#">总共 {{ answers.length }} 个回答</a></p>
                <p v-if="answers.length < 1" class="mdui-typo mdui-center mdui-typo-subheading"> <a href="#">这个问题还有回答！</a></p>
            </div>
        </Card>
        <Card class="mdui-m-y-1" v-if="answerShow" dis-hover>
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
            <form id="answer-form" action="/answers/store" method="post">
                <input type="hidden" name="_token" :value="token">
                <input type="hidden" name="id" :value="question.id">
                <div class="mdui-m-y-1">
                    <editor></editor>
                </div>
                <div>
                    <Button type="text" style=""  class="question-button question-button-color" icon="android-settings" ><strong>设置</strong></Button>
                    <Button type="primary" class="question-button" onclick="event.preventDefault();
                    document.getElementById('answer-form').submit();"><strong>提交答案</strong></Button>
                </div>
            </form>
        </Card>
        <div>
            <div class="mdui-m-y-1" v-for="item in answers">
                <answer-card :model="item" :userInfo="item.user"></answer-card>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data', 'token', 'user'],
        data() {
            return {
                question: JSON.parse(this.data),
                userInfo: JSON.parse(this.user),
                answerShow: false,
                answers: [],
                commentShow: false,
            }
        },
        mounted() {
            axios.get('/api/questions/' + this.question.id + '/answers').then(response => {
                this.answers = response.data.answers;
            });
        },
        methods: {
            submit() {
                console.log(this.inputtext);
            },
        }
    }
</script>

<style>
    .question-tag {
        border: 0px solid #fff;
        background: #eef4fa;
        font-size: 15px;
    }
    .question-tag, .question-tag a, .question-tag a:hover {
        color: #3e7ac2;
    }
    .question-button {
        font-size: 14px;
    }
    .question-button-color {
        color: #8590a6;
    }
</style>
