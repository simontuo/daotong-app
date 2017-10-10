<template>
    <div>
        <Card style="min-height:700px;">
            <Tabs @on-click="getContent">
                <TabPane label="我的动态" icon="ios-bell">
                    <div class="panel panel-default">
                        <div class="panel-heading">文章</div>
                        <div class="panel-body">
                            <ul v-for="notification in notifications">
                                <new-user-follow-notification v-if="notification.component_type === 'new_user_follow_notification'" :notification="notification"></new-user-follow-notification>
                            </ul>
                        </div>
                    </div>
                </TabPane>
                <TabPane label="最新评论" icon="chatbox-working">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul v-for="comment in comments">
                                <user-comment-list :comment="comment"></user-comment-list>
                            </ul>
                        </div>
                    </div>
                </TabPane>
                <TabPane label="我的私信" icon="chatboxes">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul v-for="message in messages">
                                <user-message-list :message="message"></user-message-list>
                            </ul>
                        </div>
                    </div>
                </TabPane>
            </Tabs>
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data() {
            return {
                notifications: [],
                comments: [],
                messages: [],
            }
        },
        mounted() {
            axios.get('/api/notifications/' + this.user).then(response => {
                this.notifications = response.data.notifications;
            });
        },
        methods: {
            getContent(id) {
                if (id == 0) {
                    axios.get('/api/notifications/' + this.user).then(response => {
                        this.notifications = response.data.notifications;
                    });
                }
                if (id == 1) {
                    axios.get('/api/comments/' + this.user).then(response => {
                        this.comments = response.data.comments;
                    });
                }
                if (id == 2) {
                    axios.get('/api/messages/' + this.user).then(response => {
                        this.messages = response.data.messages;
                    });
                }
            }
        }
    }
</script>
