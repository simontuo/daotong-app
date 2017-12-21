<template>
    <Button
        type="success"
        v-bind:class="{'ivu-btn-error': this.state}"
        size="small"
        :icon="icon"
        @click="closeComment"
    >评论</Button>
</template>

<script>
    export default {
        props: ['model', 'type'],
        data () {
            return {
                state: this.model.close_comment === 'T' ? true : false,
                icon: this.model.close_comment === 'T' ? 'close-circled' : 'checkmark-circled'
            }
        },
        mounted(){
            console.log(this.model);
        },
        methods: {
            closeComment () {
                axios.post('/api/' + this.type + '/' + this.model.id + '/closeComment').then(response => {
                    if (response.data.state === 'T') {
                        this.$Message.success({content: "关闭评论成功！", duration: 2});
                        this.state = true;
                        this.icon = 'close-circled';
                    } else {
                        this.$Message.success({content: "开启评论成功！", duration: 2});
                        this.state = false;
                        this.icon = 'checkmark-circled';
                    }
                }).catch(error => {
                    this.$Notice.info({
                        title: error.response.status,
                        desc: error.response.data.message,
                        duration: 2
                    });
                });
            }
        }
    }
</script>
