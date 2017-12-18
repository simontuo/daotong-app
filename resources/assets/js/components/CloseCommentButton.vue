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
        props: ['article'],
        data () {
            return {
                state: this.article.close_comment === 'T' ? true : false,
                icon: this.article.close_comment === 'T' ? 'close-circled' : 'checkmark-circled'
            }
        },
        mounted(){
            console.log(this.article);
        },
        methods: {
            closeComment () {
                axios.post('/api/articles/' + this.article.id + '/closeComment').then(response => {
                    if (response.data.state === 'T') {
                        this.$Message.success({content: "关闭评论成功！", duration: 2});
                        this.state = true;
                        this.icon = 'close-circled';
                    } else {
                        this.$Message.success({content: "开启评论成功！", duration: 2});
                        this.state = false;
                        this.icon = 'checkmark-circled';
                    }
                });
            }
        }
    }
</script>
