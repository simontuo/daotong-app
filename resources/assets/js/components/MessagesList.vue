<template>
    <div class="">
        <Card>
            <p slot="title">
                <Icon type="chatboxes"></Icon>
                我的对话
            </p>
            <a href="#" slot="extra" @click.prevent="changeLimit">
                <Icon type="ios-loop-strong"></Icon>
                刷新
            </a>
            <ul class="mdui-list">
                <li class="mdui-list-item mdui-m-b-1" v-for="item in messagesGroup">
                    <Badge dot>
                        <div class="mdui-list-item-avatar">
                            <img :src="item[0].from_user.avatar" />
                        </div>
                    </Badge>
                    <div class="mdui-list-item-content"> {{ item[0].bio }}</div>
                    <span>{{ item[0].created_time }}</span>
                </li>
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
