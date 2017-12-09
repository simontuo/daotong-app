<template>
    <Button
        type="success"
        v-bind:class="{'ivu-btn-error': this.state}"
        size="small"
        @click="banComment"
    >{{ this.text }}</Button>
</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                state: this.user.is_ban_comment == 1 ? true : false,
                text: this.user.is_ban_comment == 1 ? '已禁言' : '未禁言'
            }
        },
        methods: {
            banComment () {
                axios.post('/api/users/' + this.user.id + '/banComment').then(response => {
                    if (response.data.state == 1) {
                        this.$Message.success({content: "禁言成功！", duration: 2});
                        this.state = true;
                        this.text = '已禁言';
                    } else {
                        this.$Message.success({content: "取消禁言成功！", duration: 2});
                        this.state = false;
                        this.text = '未禁言';
                    }
                });
            }
        }
    }
</script>
