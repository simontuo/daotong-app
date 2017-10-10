<template>
    <li>
        {{ this.comment.bio }}
    </li>
</template>

<script>
    export default {
        props: ['comment']
    }
</script>
