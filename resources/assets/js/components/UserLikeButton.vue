<template>
    <Button type="success" size="large" @click="like">
        <Icon type="android-favorite"></Icon>
        点赞
    </Button>
</template>

<script>
    export default {
        props: ['type', 'id'],
        methods: {
            like () {
                axios.post('/api/likes/store', {'type': this.type, 'id': this.id}).then(response => {
                    if (!response.data.status) {
                        if (response.data.message) {
                            this.$Message.info({content: response.data.message, duration: 5});
                        }else {
                            this.$Message.error({content: '点赞失败！', duration: 5});
                        }
                    }else{
                        this.$emit('child-say', response.data);
                        this.$Message.success({content: '点赞成功！', duration: 2});
                    }
                }).catch(error => {
                    if (error.response.status == 401) {
                        this.showNote(error);
                    }
                });
            },
            showNote(error) {
                this.$Notice.info({
                    title: '请先登录再进行相关操作！',
                    desc: error.response.data.message,
                    duration: 2
                });
            }
        }
    }
</script>
