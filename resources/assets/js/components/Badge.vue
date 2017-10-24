<template>
    <Tooltip content="你有3条新的消息">
        <Badge dot>
            <a :href="url"><Icon type="ios-bell-outline" size="26"></Icon></a>
        </Badge>
    </Tooltip>

</template>
<script>
    export default {
        props: ['url']
    }
</script>

<style>
    .mdui-toolbar > .ivu-tooltip {
        overflow: inherit !important;
    }
    .ivu-badge > a {
        color: #fff;
    }
</style>
