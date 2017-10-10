<template>
    <li>
        <a href="#">{{ this.message.from_user.name }}</a> <Icon type="android-send"></Icon>
        {{ this.message.bio }}
    </li>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
