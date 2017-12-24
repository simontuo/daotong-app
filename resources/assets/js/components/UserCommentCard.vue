<template>
    <div class="">
        <Card dis-hover>
            <p slot="title">最新评论</p>
            <ul class="list-group">
                <li class="list-group-item" v-for="item in comments">
                    <a href="#">{{ item.commentable.title }}</a>
                    <span class="meta mdui-m-l-1">
                        <span>在 {{ item.created_time }}</span>
                    </span>
                    <p>{{ item.bio }}</p>
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
                comments: [],
            }
        },
        mounted () {
            axios.get('/api/comments/' + this.user).then(response => {
                this.comments = response.data.comments;
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
