<template>
    <Card>
        <p slot="title">
            Notifications
        </p>
        <div class="list-group">
            <div class="" v-for="item in notifications">
                <a href="#" class="list-group-item notification-list"  v-if="item.component_type == 'new_comment_notification'">
                    <div class="mdui-typo-subheading mdui-typo">
                        <Tag color="green">评论</Tag>
                        {{ item.data.name }} 评论了你的文章：
                        <a :href="/articles/ + item.data.commentable_id">{{ item.data.title }}</a>
                        <span class="pull-right">{{ item.created_time }}</span>
                    </div>
                </a>
                <a href="#" class="list-group-item notification-list"  v-if="item.component_type == 'new_user_follow_notification'">
                    <div class="mdui-typo-subheading mdui-typo">
                        <Tag color="blue">关注</Tag>
                        <a href="#">{{ item.data.name }}</a> 关注了你
                        <a href="#">test</a>
                        <span class="pull-right">{{ item.created_time }}</span>
                    </div>
                </a>
            </div>

        </div>
    </Card>
</template>

<script>
    export default {
        props: ['model'],
        data() {
            return {
                'notifications': [],
            }
        },
        mounted() {
            axios.get('/api/notifications/' + this.model).then(response => {
                this.notifications = response.data.notifications;
            });
        }
    }
</script>


<style>
    .notification-list {
        border: 0px;
        border-bottom: 1px solid #d3e0e9;
        margin-bottom: 0px;
        padding:10px 0px;

    }
    .notification-list:first-child{
        border-radius: 0px;
    }
    .notification-list:last-child{
        border-radius: 0px;
    }
    .question-tag {
        border: 0px solid #fff;
        background: #eef4fa;
        font-size: 15px;
    }
    .question-tag, .question-tag a, .question-tag a:hover {
        color: #3e7ac2;
    }
</style>
