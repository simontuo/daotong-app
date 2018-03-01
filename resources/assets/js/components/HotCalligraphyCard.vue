<template>
    <Card class="mdui-m-y-1">
        <p slot="title" style="text-align: center;">最受欢迎书法</p>
        <div style="text-align:center">
            <img width="100%" height="100%" :src="path">
        </div>
    </Card>
</template>

<script>
    export default {
        data() {
            return {
                path: '',
            }
        },
        mounted() {
            axios.get('/api/calligraphys/hot').then(response => {
                this.path = response.data.calligraphy.images.shift();
            });
        }
    }
</script>
