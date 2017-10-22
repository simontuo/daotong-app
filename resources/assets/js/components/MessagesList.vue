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
                <!-- <a :href="'/inboxs/' + user + '/' + item[0].dialog_id" > -->
                    <li class="mdui-list-item mdui-m-b-1" v-for="item in messagesGroup" @click="showDialog(item[0].dialog_id)">
                        <Badge dot>
                            <div class="mdui-list-item-avatar">
                                <img :src="item[0].to_user.avatar" v-if="user == item[0].from_user_id" />
                                <img :src="item[0].from_user.avatar" v-if="user != item[0].from_user_id" />

                            </div>
                        </Badge>
                        <div class="mdui-list-item-content"> {{ item[0].bio }}</div>
                        <span>{{ item[0].created_time }}</span>
                    </li>
                <!-- </a> -->
            </ul>
        </Card>
        <div class="mdui-dialog" :id="dialog">
            <div class="mdui-dialog-content">
                <div class="media" v-for="item in messages">
                    <div class="media-left">
                        <a href="#">
                            <Avatar src="https://i.loli.net/2017/08/21/599a521472424.jpg" size="large"/>
                        </a>
                    </div>
                    <div class="media-body">
                        {{ item.bio }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mdui-dialog" >
            <div class="mdui-dialog-content" >
                <div class="mdui-dialog-title">与XX 的对话</div>
                <div class="media" v-for="item in messages">
                    <div class="media-left">
                        <a href="#">
                            <Avatar src="https://i.loli.net/2017/08/21/599a521472424.jpg" size="large"/>
                        </a>
                    </div>
                    <div class="media-body">
                        {{ item.bio }}
                    </div>
                </div>
            </div>

            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple">cancel</button>
                <button class="mdui-btn mdui-ripple">erase</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                messagesGroup: [],
                to_user: '',
                messages: [],
            }
        },
        mounted() {
            axios.get('/api/messages/' + this.user).then(response => {
                this.messagesGroup = response.data.messages;
            });
        },
        computed: {
            dialog () {
                return 'message-dialog-';
            },
            dialogId () {
                return '#' + this.dialog;
            },
        },
        methods: {
            showDialog (id) {
                $('#' + this.dialog).attr('id', this.dialog + id);
                this.parentId = id;
                this.show(this.dialogId + id);

                axios.get('/api/messages/' + this.user + '/' + id).then(response => {
                    this.messages = response.data.messages;
                });
            },
            show (modal) {
                var dialog = new mdui.Dialog(modal);
                dialog.open();
            }
        }
    }
</script>

<style>
    .message-list {
        border-bottom: 1px solid #ddd;
    }
</style>
