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
            <Button type="ghost" class="question-button" icon="edit" @click="show = true"><strong>回答问题</strong></Button>
            <ButtonGroup>
                <Button type="text"  class="question-button question-button-color" icon="chatbubble"><strong>25 条评论</strong></Button>
                <Button type="text"  class="question-button question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
                <Button type="text"  class="question-button question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
             </ButtonGroup>
        </Card>
        <Card class="mdui-m-y-1" v-if="!show">
            <div class=" mdui-valign">
                <p class="mdui-typo mdui-center mdui-typo-subheading"> <a href="#">查看全部 25 个回答</a></p>
            </div>
        </Card>
        <Card class="mdui-m-y-1" v-if="show" dis-hover>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <Avatar size="large" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
                    </a>
                </div>
                <div class="media-body">
                    <div class="" style="max-width: 90%;">
                        <h4 class="media-heading">Media heading</h4>
                        <p class="mdui-text-truncate" >我是程序猿，只要我脑子没被门夹，我就不会有哪怕一丁点自己比省委办公厅公务员牛逼的错觉，他要是凭自己本事进去的那我自愧不如</p>
                    </div>
                </div>
            </div>
            <form id="answer-form" action="/answers/store" method="post">
                <input type="hidden" name="_token" :value="token">
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
        <Card class="mdui-m-y-1">

        </Card>
    </div>
</template>

<script>
    export default {
        props: ['data', 'token'],
        data() {
            return {
                question: JSON.parse(this.data),
                show: false,
            }
        },
        mounted() {
            // console.log(this.question);
        },
        methods: {
            submit() {
                console.log(this.inputtext);
            }
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
