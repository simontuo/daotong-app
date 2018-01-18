<template>
    <Button type="primary" class="question-button"
    @click="follow"
    ><strong>{{ text }}</strong></Button>
</template>

<script>
    export default {
        props: ['model'],
        data() {
            return {
                followed: false,
            }
        },
        mounted() {
            console.log(1);
            axios.get('/api/user/questions/followed/' + this.model).then(response => {
                this.followed = response.data.followed;
            });
        },
        computed: {
            text() {
                return this.followed ? "已关注了该问题" : "关注该问题";
            }
        },
        methods: {
            follow() {
                axios.post('/api/questions/follow', {'question': this.model}).then(response => {
                    if (response.data.status) {
                        this.$Message.info({content: response.data.message, duration: 2});
                    }else {
                        this.followed = response.data.followed;
                        this.$Message.success({content: this.followed ? '已关注' : '已取消关注', duration: 2});
                    }
                });
            }
        }
    }
</script>
