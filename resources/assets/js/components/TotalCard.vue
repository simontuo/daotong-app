<template>
    <Card>
        <p style="text-align:center" class="mdui-typo-display-1 mdui-text-color-pink">
            {{ this.total }}
        </p>
        <p style="text-align:center" class="mdui-typo-headline">
            {{ this.describe }}
        </p>
    </Card>
</template>

<script>
    export default {
        props: ['type', 'describe'],
        data() {
            return {
                total: '',
            }
        },
        mounted() {
            axios.get('/api/statistics/' + this.type + 'Total').then(response => {
                this.total = response.data.total;
            });
        }
    }
</script>
