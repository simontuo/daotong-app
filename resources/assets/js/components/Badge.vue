<template>
    <div class="notifications-brdge">
        <Tooltip :content="'你有' + count + '条新的消息'" v-if="count > 0">
            <Badge dot>
                <a :href="url"><Icon type="ios-bell-outline" size="26"></Icon></a>
            </Badge>

        </Tooltip>
        <Badge>
            <a :href="url" v-if="count == 0"><Icon type="ios-bell-outline" size="26"></Icon></a>
        </Badge>
    </div>

</template>
<script>
    export default {
        props: ['url', 'user'],
        data() {
            return {
                count: 0,
            }
        },
        mounted() {
            axios.get('/api/notifications/noRead').then(response => {
                this.count = response.data.notifications.length;
            });
        }
    }
</script>

<style>
    .mdui-toolbar > .notifications-brdge {
        overflow: inherit !important;
    }
    .ivu-badge > a {
        color: #fff;
    }
</style>
