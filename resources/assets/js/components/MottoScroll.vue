<template>
    <marquee class="mdui-typo-subheading" style="width: 100%;" scrollamount="3" direction="left" behaviour="Scroll">
        <span class="ivu-tag-dot-inner mdui-color-pink"></span>{{ motto.bio }}
    </marquee>
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
