<template>
    <button class="btn btn-primary" @click="getVerificationCode" type="button">获取</button>
</template>

<script>
    export default {
        data() {
            return {
                status: false,
            }
        },
        methods: {
            getVerificationCode() {
                axios.get('/api/verifyCodes/registerCode', {params: {'phone':15918764270}}).then(response => {
                    console.log(response.data);
                });
            }
        }
    }
</script>
