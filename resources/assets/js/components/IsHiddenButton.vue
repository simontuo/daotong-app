<template>
    <Button
        type="success"
        v-bind:class="{'ivu-btn-error': this.state}"
        size="small"
        :icon="icon"
        @click="isHidden"
    >屏蔽</Button>
</template>

<script>
    export default {
        props: ['model', 'type'],
        data () {
            return {
                state: this.model.is_hidden === 'T' ? true : false,
                icon: this.model.is_hidden === 'T' ? 'close-circled' : 'checkmark-circled'
            }
        },
        methods: {
            isHidden () {
                axios.post('/api/' + this.type + '/' + this.model.id + '/isHidden').then(response => {
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
