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
                        <a :href="/users/ + item.data.id + '/center'">{{ item.data.name }}</a>
                        评论了你的文章：
                        <a :href="/articles/ + item.data.commentable_id">{{ item.data.title }}</a>
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                </a>
                <a href="#" class="list-group-item notification-list"  v-if="item.component_type == 'new_user_follow_notification'">
                    <div class="mdui-typo-subheading mdui-typo">
                        <Tag color="blue">关注</Tag>
                        <a href="#">{{ item.data.name }}</a> 关注了你!
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                </a>
                <a href="#" class="list-group-item notification-list"  v-if="item.component_type == 'ban_user_comment_notification'">
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.is_ban_comment == 'T'">
                        <Tag color="red">评论</Tag>
                        <a href="#">{{ item.data.name }}</a>
                        <span>管理员将你禁止评论了！</span>
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.is_ban_comment == 'F'">
                        <Tag color="yellow">解除</Tag>
                        <a href="#">{{ item.data.name }}</a>
                        <span>管理员解除了你的禁止评论状态！</span>
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                </a>
                <a href="#" class="list-group-item notification-list"  v-if="item.component_type == 'ban_user_login_notification'">
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.is_ban_login == 'T'">
                        <Tag color="red">登录</Tag>
                        <a href="#">{{ item.data.name }}</a>
                        <span>管理员将禁止登录了！</span>
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.is_ban_login == 'F'">
                        <Tag color="yellow">解除</Tag>
                        <a href="#">{{ item.data.name }}</a>
                        <span>管理员解除了你的禁止登录状态！</span>
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                </a>
                <a href="#" class="list-group-item notification-list"  v-if="item.component_type == 'close_comment_notification'">
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.close_comment == 'T'">
                        <Tag color="red">评论</Tag>
                        <span>管理员关闭了你的：</span>
                        <a>{{ item.data.title }}</a> 评论！
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.close_comment == 'F'">
                        <Tag color="yellow">解除</Tag>
                        <span>管理员解除了你的：</span>
                        <a>{{ item.data.title }}</a> 关闭评论的状态！
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                </a>
                <a href="#" class="list-group-item notification-list"  v-if="item.component_type == 'hidden_notification'">
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.is_hidden == 'T'">
                        <Tag color="red">屏蔽</Tag>
                        <span>管理员屏蔽了你的：</span>
                        <a>{{ item.data.title }}</a>
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                    </div>
                    <div class="mdui-typo-subheading mdui-typo" v-if="item.data.is_hidden == 'F'">
                        <Tag color="yellow">解除</Tag>
                        <span>管理员解除了你的：</span>
                        <a>{{ item.data.title }}</a> 屏蔽的状态！
                        <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
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
