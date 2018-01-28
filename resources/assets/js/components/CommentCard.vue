<template>
    <Card dis-hover>
        <div class="mdui-valign">
            <Spin class="mdui-center" size="large" v-if="spinShow"></Spin>
        </div>
        <p slot="title">
            {{ this.count }} 条评论
        </p>
        <a slot="extra" @click.prevent="reverse">
            <Icon size="20" type="arrow-swap"></Icon>
        </a>
        <div class="mdui-m-b-1" v-if="!spinShow" v-for="item in comments">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <Avatar shape="square" size="small" style="line-height: 23px;" :src="item.user.avatar" />
                    </a>
                </div>
                <div class="media-body">
                    <p class="media-heading mdui-text-capitalize" style="font-size:16px;">
                        {{ item.user.name }}
                        <span class="pull-right question-button-color"><small>{{ item.created_time }}</small></span>
                    </p>
                </div>
            </div>
            <p class="media-heading" style="font-size:16px;">{{ item.bio }}</p>
            <ButtonGroup style="margin-left: -15px;">
                <Button type="text"  class="question-button-color" icon="chatbubble"><strong>25 条评论</strong></Button>
                <Button type="text"  class="question-button-color" icon="android-share-alt"><strong>分享</strong></Button>
                <Button type="text"  class="question-button-color" icon="star"><strong></Icon>邀请回答</strong></Button>
            </ButtonGroup>
            <div class="mdui-divider"></div>
        </div>

        <div class="">
            <Form ref="formInline" inline>
                <FormItem prop="user" style="margin-bottom: 0px;width: 90%;">
                    <Input v-model="bio" :autosize="true"  type="textarea" :rows="1" size="large" placeholder="写下你的评论"></Input>
                </FormItem>
                <FormItem style="margin-bottom: 0px;">
                    <Button type="primary" @click="storeCommemt">评论</Button>
                </FormItem>
            </Form>
        </div>

    </Card>
</template>

<script>
    export default {
        props: ['model', 'type'],
        data() {
            return {
                bio: '',
                parentId: 0,
                spinShow: true,
                comments: [],
                count: '',
            }
        },
        mounted() {
            axios.get('/api/comments/' + this.type + '/' + this.model).then(response => {
                this.count = response.data.comments.length;
                if (this.count > 0) {
                    this.comments = response.data.comments;
                }
                setTimeout(() => {
                    this.spinShow = false;
                }, 200);

            })
        },
        methods: {
            storeCommemt() {
                axios.post('/api/comments/store', {'parentId': this.parentId, 'bio':this.bio, 'type': this.type, 'model': this.model}).then(response => {
                    if (!response.data.status) {
                        this.$Message.error({content: response.data.message, duration: 4});
                    } else {
                        this.count ++;
                        this.comments.push(response.data.comment);
                        this.$Message.success({content: response.data.message, duration: 2});
                    }
                }).catch(error => {
                    this.$Notice.info({
                        title: '请先登录再进行相关操作！',
                        desc: error.response.data.message,
                        duration: 2
                    });
                });
                this.bio = '';
            },
            reverse() {
                this.comments = this.comments.reverse();
            }
        }
    }
</script>
