<template>
    <Card class="mdui-m-y-1">
        <p slot="title" style="text-align: center;">每日一读</p>
        <span class="ivu-tag-dot-inner mdui-color-pink"></span>{{ motto.bio }}
    </Card>

</template>

<script>
    export default {
        data() {
            return {
                motto: '',
            }
        },
        mounted() {
            axios.get('/api/mottoes/randomOne').then(response => {
                this.motto = response.data.motto;
            });
        }
    }
</script>
