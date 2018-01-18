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
            <Button type="ghost" class="question-button" icon="edit"><strong>回答问题</strong></Button>
            <ButtonGroup>
                <Button type="text"  class="question-button question-button-color" icon="chatbubble"><strong></Icon>25 条评论</strong></Button>
                <Button type="text"  class="question-button question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
                <Button type="text"  class="question-button question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
             </ButtonGroup>
        </Card>
        <Card class="mdui-m-y-1">
            <div class=" mdui-valign">
                <p class="mdui-typo mdui-center mdui-typo-subheading"> <a href="#">查看全部 25 个回答</a></p>
            </div>
        </Card>
        <Card class="mdui-m-y-1">

        </Card>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {
                question: JSON.parse(this.data),
            }
        },
        mounted() {
            // console.log(this.question);
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
