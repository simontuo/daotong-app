<template>
    <div>
        <Card>
            <span v-for="item in question.topics">
                <Tag class="question-tag" >{{ item.name }}</Tag>
            </span>

            <Tag class="question-tag" v-if="question.topics.length == 0">没有对应的topic</Tag>
            <div class="mdui-typo-title">{{ question.title }}</div>
            <div class="mdui-typo-subheading">{{ question.bio }}</div>
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
            console.log(this.question);
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
</style>
