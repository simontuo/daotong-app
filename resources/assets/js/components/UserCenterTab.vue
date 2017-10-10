<template>
    <div>
        <Card style="min-height:700px;">
            <Tabs>
                <TabPane label="我的动态" icon="ios-bell">
                    <div class="panel panel-default">
                        <div class="panel-heading">文章</div>
                        <div class="panel-body">
                            <ul v-for="notification in notifications">
                                <new-user-follow-notification v-if="notification.component_type === 'new_user_follow_notification'" :notification="notification"></new-user-follow-notification>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">评论</div>
                        <div class="panel-body">
                            You are logged in!
                        </div>
                    </div>
                </TabPane>
                <TabPane label="最新评论" icon="chatbox-working">
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>
                        <div class="panel-body">
                            You are logged in!
                        </div>
                    </div>
                </TabPane>
                <TabPane label="我的私信" icon="chatboxes">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <li>
                                <a href="#">john</a> 关注了你！
                            </li>
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
            }
        },
        mounted() {
            axios.get('/api/notifications/' + this.user).then(response => {
                this.notifications = response.data.notifications;
                console.log(response.data);
            });
        },
        methods: {

        }
    }
</script>
