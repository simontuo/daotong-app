<template>
    <div class="">
        <Card dis-hover>
            <p slot="title">最新评论</p>
            <ul class="list-group">
                <li class="list-group-item" v-for="item in comments">
                    <a href="#">{{ item.bio }}</a>
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
            axios.get('/api/comments/getUsercomments/' + this.user).then(response => {
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
