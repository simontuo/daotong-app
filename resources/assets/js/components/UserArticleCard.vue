<template>
    <div class="mdui-m-b-3">
        <Card dis-hover>
            <p slot="title">文章专栏</p>
            <ul class="list-group">
                <li class="list-group-item" v-for="item in articles">
                    <a href="#">{{ item.title }}</a>
                    <span class="meta mdui-m-l-1">
                        <a href="" :title="item.user_name">
                            {{ item.user_name }}
                        </a>
                        <span> ⋅ </span>
                        {{ item.likes.length }} 点赞
                        <span> ⋅ </span>
                        {{ item.comments_count }} 回复
                        <span> ⋅ </span>
                        <span>{{ item.created_time }}</span>
                    </span>
                </li>
            </ul>
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data () {
            return {
                articles: [],
            }
        },
        mounted () {
            axios.get('/api/articles/getUserArticles/' + this.user).then(response => {
                this.articles = response.data.articles;
            });
        }
    }
</script>
<style>
    .list-group-item {
        border: none;
        margin-bottom: 0px;
        border-bottom: 1px solid #f2f2f2;
    }
    .meta , .meta a{
        color: #d0d0d0;
        font-size: 12px;
    }
</style>
