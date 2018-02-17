<template>
    <Card style="text-align: center;">
        <p slot="title" class="mdui-typo-title-opacity">
            热门标签
        </p>
        <span v-for="item in topics">
            <Tag checkable class="question-tag mdui-m-r-1 mdui-m-b-1">{{ item.name }}</Tag>
        </span>

    </Card>
</template>

<script>
    export default {
        data() {
            return {
                topics: [],
            }
        },
        mounted() {
            axios.get('/api/topics/hot').then(response => {
                this.topics = response.data.topics;
            });
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
