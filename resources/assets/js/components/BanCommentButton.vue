<template>
    <Button
        type="success"
        v-bind:class="{'ivu-btn-error': this.state}"
        size="small"
        :icon="icon"
        @click="banComment"
    >禁言</Button>
</template>

<script>
    export default {
        props: ['user'],
        data () {
            return {
                state: this.user.is_ban_comment === 'T' ? true : false,
                icon: this.user.is_ban_comment === 'T' ? 'close-circled' : 'checkmark-circled'
            }
        },
        methods: {
            banComment () {
                axios.post('/api/users/' + this.user.id + '/banComment').then(response => {
                    if (response.data.state === 'T') {
                        this.$Message.success({content: "禁言成功！", duration: 2});
                        this.state = true;
                        this.icon = 'close-circled';
                    } else {
                        this.$Message.success({content: "取消禁言成功！", duration: 2});
                        this.state = false;
                        this.icon = 'checkmark-circled';
                    }
                });
            }
        }
    }
</script>
