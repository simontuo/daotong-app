<template>
    <Card>
        <div style="text-align:center" v-if="!spinShow">
            <!-- 打赏/点赞 -->
            <p slot="title" class="mdui-m-b-2">
                <ButtonGroup>
                    <user-like-button :id="model" :type="type" v-on:child-say="getLikeUser"></user-like-button>
                    <Button type="warning" size="large"  @click="show">
                        打赏
                        <Icon type="social-yen"></Icon>
                    </Button>
                </ButtonGroup>
            </p>
            <Modal title="打赏二维码" v-model="visible">
                <img :src="code" v-if="visible" style="width: 100%">
            </Modal>
            <!-- 用户头像列 -->
            <a href="/" class="like-avatar-lisl" v-for="user in users">
                <Avatar class="like-avatar" :src="user.user.avatar" />
            </a>
        </div>
        <div class="spin-container mdui-center" v-if="spinShow">
            <Spin size="large" fix v-if="spinShow"></Spin>
        </div>
    </Card>
</template>
<script>
    export default {
        props: ['model', 'type', 'code'],
        data () {
            return {
                spinShow: true,
                users: [],
                visible: false
            }
        },
        mounted() {
            axios.get('/api/likes/' + this.type + '/' + this.model).then(response => {
                if (!response.data.status) {
                    this.$Message.error({content: '点赞加载失败！', duration: 5});
                }
                this.users = response.data.likes;
                this.spinShow = false;
            })
        },
        methods: {
            getLikeUser (user) {
                this.users.push(user);
            },
            show() {
                this.visible = true;
            }
        }
    }
</script>
<style>
    .like-avatar-lisl {
        margin: 0px 4px;
    }
    .like-avatar{
        background-color: #fff;
        border: 1px solid #ddd;
        width: 60px;
        height: 60px;
        border-radius: 60px;
    }
    .like-avatar img{
        margin: 4px;
        width: 50px;
        height: 50px;
        border-radius: 50px;
    }
    .spin-container{
    	display: inline-block;
        width: 50px;
        height: 50px;
        position: relative;
    }
</style>
