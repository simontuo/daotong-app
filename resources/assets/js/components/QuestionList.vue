<template>
    <ul class="list-group">
        <a class="list-group-item">
            <span class="mdui-typo-headline-opacity">问题列表</span>
        </a>
        <a class="list-group-item" v-for="item in questions" :href="'/questions/' + item.id">
            <h4 class="mdui-m-b-1"><small> {{ item.user.name }}</small> - <small>{{ item.created_time }}</small></h4>
            <h4 class="mdui-m-b-2">{{ item.title }}</h4>
            <ButtonGroup >
                <Button type="ghost" size="small" class="question-list-button">
                    <Icon type="heart"></Icon>
                    22
                </Button>
                <Button class="question-list-button" type="ghost" size="small">
                    <Icon type="ios-chatboxes"></Icon>
                    10
                </Button>
            </ButtonGroup>
        </a>
        <a class="list-group-item mdui-valign" v-if="questions.length == 0"><h4 class="mdui-center mdui-m-b-1"><small>没有人提问哦</small></h4></a>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                questions: [],
            }
        },
        mounted() {
            axios.get('/api/questions/index').then(response => {
                this.questions = response.data.questions.data;
            });
        }
    }
</script>

<style media="screen">
    .list-group-item {
        border: 1px solid #eef5f9;
    }
    .question-list-button {
        color: #b2bac2;
    }
</style>
