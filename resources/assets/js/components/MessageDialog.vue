<template>
    <div class="">
        <Card>
            <p slot="title">
                <Icon type="chatboxes"></Icon>
                与 John 的对话
            </p>
            <a href="#" slot="extra">
                <Icon type="ios-loop-strong"></Icon>
                刷新
            </a>
            <div class="row chat-div mdui-m-x-2 mdui-m-b-2" id="chat-div">
                <div class="media" v-for="item in messages">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object mdui-img-rounded" width="50" :src="item.from_user.avatar">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ item.from_user.name }}</h4>
                        <p>
                            {{ item.bio }}
                            <span class="pull-right">{{ item.created_time }}</span>
                        </p>
                    </div>
                </div>

            </div>
            <Form>
                <FormItem>
                    <Input class="mdui-m-b-1" v-model="bio" type="textarea" :autosize="{minRows: 2,maxRows: 5}" placeholder="请输入..."></Input>
                    <Button class="pull-right" type="primary" @click="send">回复</Button>
                </FormItem>
            </Form>
        </Card>
    </div>
</template>

<script>
    export default {
        props: ['user', 'dialog'],
        data() {
            return {
                messages: [],
                bio: '',
            }
        },
        mounted() {
            axios.get('/api/messages/' + this.user + '/' + this.dialog).then(response => {
                this.messages = response.data.messages;
                this.scrollBottom();
            });


        },
        methods: {
            send() {
                axios.post('/api/messages/reply', {'dialog': this.dialog, 'bio': this.bio}).then(response => {
                    if (response.data.status && response.data.status !== 'info') {
                        this.bio = '';
                        this.messages.push(response.data.data);
                        this.$Message.success({content: response.data.message, duration: 2});
                    }else if (!response.data.status) {
                        this.$Message.error({content: response.data.message, duration: 2});
                    }else {
                        this.$Message.info({content: response.data.message, duration: 2});
                    }
                });
            },
            scrollBottom() {
                $(document).ready(function() {
                    $('#chat-div').scrollTop( $('#chat-div')[0].scrollHeight );
                });
            }
        }
    }
</script>

<style>
    .chat-div {
        min-height: 300px;
        max-height: 500px;
        overflow: auto;
    }
</style>
