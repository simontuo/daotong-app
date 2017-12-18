<template>
    <Button
        type="success"
        v-bind:class="{'ivu-btn-error': this.state}"
        size="small"
        :icon="icon"
        @click="closeComment"
    >屏蔽</Button>
</template>

<script>
    export default {
        props: ['article'],
        data () {
            return {
                state: this.article.is_hidden === 'T' ? true : false,
                icon: this.article.is_hidden === 'T' ? 'close-circled' : 'checkmark-circled'
            }
        },
        mounted(){
            console.log(this.article);
        },
        methods: {
            closeComment () {
                axios.post('/api/articles/' + this.article.id + '/isHidden').then(response => {
                    if (response.data.state === 'T') {
                        this.$Message.success({content: "屏蔽成功！", duration: 2});
                        this.state = true;
                        this.icon = 'close-circled';
                    } else {
                        this.$Message.success({content: "取消屏蔽成功！", duration: 2});
                        this.state = false;
                        this.icon = 'checkmark-circled';
                    }
                });
            }
        }
    }
</script>
