<template>
    <div class="mdui-m-b-3">
        <Card dis-hover>
            <p slot="title">书法专栏</p>
            <ul class="list-group">
                <li class="list-group-item" v-for="item in calligraphys">
                    <div class="mdui-typo-subheading mdui-typo">
                        <a href="#">{{ item.title }}</a>
                        <span class="mdui-m-l-1">
                            <small class="pull-right mdui-hidden-sm-down">
                                <a href="" :title="item.user_name">
                                    {{ item.user_name }}
                                </a>
                                <span> ⋅ </span>
                                {{ item.likes.length }} 点赞
                                <span> ⋅ </span>
                                {{ item.comments_count }} 回复
                                <span> ⋅ </span>
                                <span>{{ item.created_time }}</span>
                            </small>
                            <small class="mdui-hidden-sm-up">
                                <a href="" :title="item.user_name">
                                    {{ item.user_name }}
                                </a>
                                <span> ⋅ </span>
                                {{ item.likes.length }} 点赞
                                <span> ⋅ </span>
                                {{ item.comments_count }} 回复
                                <span> ⋅ </span>
                                <span>{{ item.created_time }}</span>
                            </small>
                        </span>
                    </div>
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
                calligraphys: [],
            }
        },
        mounted () {
            axios.get('/api/calligraphys/' + this.user).then(response => {
                this.calligraphys = response.data.calligraphys;
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
