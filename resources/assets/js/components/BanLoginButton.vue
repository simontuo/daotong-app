<template>
    <Button
        type="success"
        v-bind:class="{'ivu-btn-error': this.state}"
        size="small"
        :icon="icon"
        @click="banLogin"
    >登录</Button>
</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                state: this.user.is_ban_login == 1 ? true : false,
                icon: this.user.is_ban_login == 1 ? 'close-circled' : 'checkmark-circled'
            }
        },
        methods: {
            banLogin () {
                axios.post('/api/users/' + this.user.id + '/banLogin').then(response => {
                    if (response.data.state == 1) {
                        this.$Message.success({content: "禁止登录成功！", duration: 2});
                        this.state = true;
                        this.icon = 'close-circled';
                    } else {
                        this.$Message.success({content: "取消禁止登录成功！", duration: 2});
                        this.state = false;
                        this.icon = 'checkmark-circled';
                    }
                });
            }
        }
    }
</script>
