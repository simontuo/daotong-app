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
                axios.get('/api/verifyCodes/registerCode', {params: {'phone':15915863547}}).then(response => {
                    console.log(response.data);
                    if (response.data.status) {
                        this.$Message.success({content: '验证码发送成功！', duration: 2});
                    }
                });
            }
        }
    }
</script>
