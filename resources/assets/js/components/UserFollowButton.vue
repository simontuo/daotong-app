<template>
    <Button type="info" size="large" @click="follow">
        <Icon type="android-add" v-if="!followed"></Icon>
        <Icon type="checkmark" v-if="followed"></Icon>
        {{ text }}
    </Button>
</template>

<script>
    export default {
        props: ['user'],
        mounted() {
            axios.get('/api/user/followers/' + this.user).then(response => {
                this.followed = response.data.followed
            })
        },
        data() {
            return {
                followed: false,
            }
        },
        computed: {
            text() {
                return this.followed ? '已关注' : '关注他'
            }
        },
        methods: {
            follow() {
                axios.post('/api/user/follow', {'user': this.user}).then(response => {
                    if (response.data.status) {
                        this.$Message.info({content: response.data.message, duration: 2});
                    }else {
                        this.followed = response.data.followed;
                        this.$Message.success({content: this.followed ? '已关注' : '已取消关注', duration: 2});
                    }
                })
            }
        }
    }
</script>
