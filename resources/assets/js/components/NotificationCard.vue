<template>
    <Card>
        <p slot="title">
            Notifications: {{ count }}
        </p>
        <a href="#" slot="extra" @click.prevent="hasRead" v-if="status">
            已读
        </a>
        <a href="#" slot="extra" @click.prevent="noRead" v-if="!status">
            未读
        </a>
        <div v-for="item in notifications" v-if="status">
            <Alert type="success" show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'new_comment_notification'">
                评论
                <span slot="desc"><a :href="/users/ + item.data.id + '/center'">{{ item.data.name }}</a>
                评论了你的文章：
                <a :href="/articles/ + item.data.commentable_id">{{ item.data.title }}</a>
                <span class="pull-right">{{ item.created_time }}</span> </span>
            </Alert>
            <Alert type="success" show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'new_message_notificaiton'">
                消息
                <span slot="desc"><a :href="/users/ + item.data.id + '/center'">{{ item.data.name }}</a>
                发了一条信息给你，请查看与他的对话。
                <span class="pull-right">{{ item.created_time }}</span> </span>
            </Alert>
            <Alert show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'new_user_follow_notification'">
                关注
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a> 关注了你!
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="error" show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'ban_user_comment_notification' & item.data.is_ban_comment == 'T'">
                禁止评论
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员解除了你的禁止评论状态！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'ban_user_comment_notification' & item.data.is_ban_comment == 'F'">
                解除禁止评论状态
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员解除了你的禁止评论状态！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="error" show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'ban_user_login_notification' & item.data.is_ban_login == 'T'">
                禁止登录
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员将禁止登录了！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'ban_user_login_notification' & item.data.is_ban_login == 'F'">
                解除禁止登录状态
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员解除了你的禁止登录状态！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="warning" show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'close_comment_notification' & item.data.close_comment == 'T'">
                关闭评论
                <span slot="desc">
                    <span>管理员关闭了你的：</span>
                    <a>{{ item.data.title }}</a> 评论！
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'close_comment_notification' & item.data.close_comment == 'F'">
                解除关闭关闭评论状态
                <span slot="desc">
                    <span>管理员解除了你的：</span>
                    <a>{{ item.data.title }}</a> 关闭评论的状态！
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="warning" show-icon @on-close="read(item.id)" closable v-if="item.component_type == 'hidden_notification' & item.data.is_hidden == 'T'">
                屏蔽
                <span slot="desc">
                    <span>管理员解除了你的：</span>
                    <a>{{ item.data.title }}</a> 关闭评论的状态！
                    <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon closable @on-close="read(item.id)" v-if="item.component_type == 'hidden_notification' & item.data.is_hidden == 'F'">
                解除屏蔽状态
                <span slot="desc">
                    <span>管理员解除了你的：</span>
                    <a>{{ item.data.title }}</a> 屏蔽的状态！
                    <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                </span>
            </Alert>
        </div>
        <div v-for="item in notifications" v-if="!status">
            <Alert type="success" show-icon v-if="item.component_type == 'new_comment_notification'">
                评论
                <span slot="desc"><a :href="/users/ + item.data.id + '/center'">{{ item.data.name }}</a>
                评论了你的文章：
                <a :href="/articles/ + item.data.commentable_id">{{ item.data.title }}</a>
                <span class="pull-right">{{ item.created_time }}</span> </span>
            </Alert>
            <Alert type="success" v-if="item.component_type == 'new_message_notificaiton'">
                消息
                <span slot="desc"><a :href="/users/ + item.data.id + '/center'">{{ item.data.name }}</a>
                发了一条信息给你，请查看与他的对话。
                <span class="pull-right">{{ item.created_time }}</span> </span>
            </Alert>
            <Alert show-icon v-if="item.component_type == 'new_user_follow_notification'">
                关注
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a> 关注了你!
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="error" show-icon v-if="item.component_type == 'ban_user_comment_notification' & item.data.is_ban_comment == 'T'">
                禁止评论
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员解除了你的禁止评论状态！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon v-if="item.component_type == 'ban_user_comment_notification' & item.data.is_ban_comment == 'F'">
                解除禁止评论状态
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员解除了你的禁止评论状态！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="error" show-icon v-if="item.component_type == 'ban_user_login_notification' & item.data.is_ban_login == 'T'">
                禁止登录
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员将禁止登录了！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon v-if="item.component_type == 'ban_user_login_notification' & item.data.is_ban_login == 'F'">
                解除禁止登录状态
                <span slot="desc">
                    <a href="#">{{ item.data.name }}</a>
                    <span>管理员解除了你的禁止登录状态！</span>
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="warning" show-icon v-if="item.component_type == 'close_comment_notification' & item.data.close_comment == 'T'">
                关闭评论
                <span slot="desc">
                    <span>管理员关闭了你的：</span>
                    <a>{{ item.data.title }}</a> 评论！
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon v-if="item.component_type == 'close_comment_notification' & item.data.close_comment == 'F'">
                解除关闭关闭评论状态
                <span slot="desc">
                    <span>管理员解除了你的：</span>
                    <a>{{ item.data.title }}</a> 关闭评论的状态！
                    <span class="pull-right">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert type="warning" show-icon @on-close="read(item.id)" closable v-if="item.component_type == 'hidden_notification' & item.data.is_hidden == 'T'">
                屏蔽
                <span slot="desc">
                    <span>管理员解除了你的：</span>
                    <a>{{ item.data.title }}</a> 关闭评论的状态！
                    <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                </span>
            </Alert>
            <Alert show-icon v-if="item.component_type == 'hidden_notification' & item.data.is_hidden == 'F'">
                解除屏蔽状态
                <span slot="desc">
                    <span>管理员解除了你的：</span>
                    <a>{{ item.data.title }}</a> 屏蔽的状态！
                    <span class="pull-right mdui-hidden-sm-down">{{ item.created_time }}</span>
                </span>
            </Alert>
        </div>
        <div class="mdui-typo mdui-valign" v-if="notifications.length == 0">
            <p class="mdui-center"><a href="#">暂无通知~</a></p>
        </div>
    </Card>
</template>

<script>
    export default {
        props: ['model'],
        data() {
            return {
                'notifications': [],
                'count': 0,
                'status': true,
            }
        },
        mounted() {
            axios.get('/api/notifications/noRead').then(response => {
                this.notifications = response.data.notifications;
                this.count = response.data.notifications.length;
            });
        },
        methods: {
            read(id) {
                axios.get('/api/notifications/' + id + '/read').then(response => {
                    if (response.data.status) {
                        this.$Message.success({content: " 已阅读了通知！", duration: 1});
                        this.count --;
                    }
                });
            },
            hasRead() {
                axios.get('/api/notifications/hasRead').then(response => {
                    this.notifications = response.data.notifications;
                    this.count = response.data.notifications.length;
                    this.status = false;
                });
            },
            noRead() {
                axios.get('/api/notifications/noRead').then(response => {
                    this.notifications = response.data.notifications;
                    this.count = response.data.notifications.length;
                    this.status = true;
                });
            }
        }
    }
</script>
