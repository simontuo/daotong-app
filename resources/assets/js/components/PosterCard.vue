<template>
    <Card class="mdui-m-b-1" >
        <div style="text-align:center">
            <img class="mdui-m-b-1" width="100%" height="100%" :src="this.poster.poster">
            <h4>{{ this.poster.poster_bio }}</h4>
        </div>
    </Card>
</template>

<script>
    export default {
        data() {
            return {
                // show: true,
                poster: ''
            }
        },
        mounted() {
            axios.get('/api/settings/poster').then(response => {
                this.poster = response.data;
            });
        }
    }
</script>
