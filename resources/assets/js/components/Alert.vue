<template>
    <div>
        <Alert :type="type" show-icon closable>
            {{ content }}
            <span slot="desc"></span>
        </Alert>
    </div>
</template>
<script>
    export default {
        props: ['type', 'content']
    }
</script>
