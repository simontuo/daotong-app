<template>
    <span>
        <Button type="success" size="large" @click="showmModal">
            <Icon type="chatbubbles"></Icon>
            发私信
        </Button>
        <!-- 私信dialog -->
        <div class="mdui-dialog" id="message-dialog">
            <div class="mdui-dialog-title">发送私信给：{{ this.name }}</div>
            <div class="mdui-dialog-content">
                <div class="mdui-textfield">
                    <textarea class="mdui-textfield-input" v-model="bio" placeholder="私信内容"></textarea>
                </div>
            </div>
            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple" mdui-dialog-confirm @click="message()">发送</button>
                <button class="mdui-btn mdui-ripple" mdui-dialog-cancel @click="emptyTextarea">取消</button>
            </div>
        </div>
    </span>
</template>

<script>
    export default {
        props: ['user', 'name'],
        data () {
            return {
                bio: '',
            }
        },
        methods: {
            showmModal () {
                var dialog = new mdui.Dialog('#message-dialog');
                dialog.open();
            },
            message () {
                axios.post('/api/messages/store', {'user': this.user, 'bio': this.bio}).then(response => {
                    this.bio = '';
                    if (response.data.status && response.data.status !== 'info') {
                        this.$Message.success({content: response.data.message, duration: 2});
                    }else if (!response.data.status) {
                        this.$Message.error({content: response.data.message, duration: 2});
                    }else {
                        this.$Message.info({content: response.data.message, duration: 2});
                    }
                });
            },
            emptyTextarea () {
                this.bio = '';
            }
        }
    }
</script>
