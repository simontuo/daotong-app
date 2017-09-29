<template>
    <Card>
        <div style="text-align:center" v-if="!spinShow">
            <!-- 打赏/点赞 -->
            <p slot="title" class="mdui-m-b-2">
                <ButtonGroup>
                    <user-like-button></user-like-button>
                    <Button type="warning" size="large">
                        打赏
                        <Icon type="social-yen"></Icon>
                    </Button>
                </ButtonGroup>
            </p>
            <!-- 用户头像列 -->
            <a href="/" class="like-avatar-lisl" v-for="user in users">
                <Avatar class="like-avatar" :src="user.user.avatar" />
            </a>
        </div>
        <div class="spin-container mdui-center">
            <Spin size="large" fix v-if="spinShow"></Spin>
        </div>
    </Card>
</template>
<script>
    export default {
        props: ['id', 'type'],
        data () {
            return {
                spinShow: true,
                users: [],
            }
        },
        mounted() {
            axios.get('/api/likes/' + this.type + '/' + this.id).then(response => {
                if (!response.data.status) {
                    this.$Message.error({content: '点赞加载失败！', duration: 5});
                }
                this.users = response.data.likes;
                this.spinShow = false;
            })
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
