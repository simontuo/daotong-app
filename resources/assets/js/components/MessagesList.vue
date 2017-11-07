<template>
    <div class="">
        <Card>
            <p slot="title">
                <Icon type="chatboxes"></Icon>
                我的对话
            </p>
            <a href="#" slot="extra">
                <Icon type="ios-loop-strong"></Icon>
                刷新
            </a>
            <ul class="mdui-list">
                <a :href="'/inboxs/' + user + '/' + item[0].dialog_id" v-for="item in messagesGroup">
                    <li class="mdui-list-item mdui-m-b-1">

                        <div class="mdui-list-item-avatar mdui-m-l-1">
                            <img :src="item[0].to_user.avatar" v-if="user == item[0].from_user_id" />
                            <img :src="item[0].from_user.avatar" v-if="user != item[0].from_user_id" />
                        </div>

                        <div class="mdui-list-item-content">
                            <span class="label label-warning" v-if="item[0].has_read == 'F' && user != item[0].from_user_id">未读</span>
                            {{ item[0].bio }}
                        </div>
                        <span>{{ item[0].created_time }}</span>
                    </li>
                </a>
            </ul>
        </Card>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                messagesGroup: [],
            }
        },
        mounted() {
            axios.get('/api/messages/' + this.user).then(response => {
                this.messagesGroup = response.data.messages;
            });
        }
    }
</script>

<style>
    .message-list {
        border-bottom: 1px solid #ddd;
    }
</style>
