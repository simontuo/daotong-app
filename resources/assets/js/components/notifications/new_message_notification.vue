<template>
    <li>
        <a :href="'/users/' + this.notification.data.id + '/center'">{{ this.notification.data.name }}</a> 发送私信给你。
    </li>
</template>


<script>
    export default {
        props: ['notification'],
        data() {
            return {

            }
        },
        mounted() {
            console.log(this.notification)
        }
    }
</script>
