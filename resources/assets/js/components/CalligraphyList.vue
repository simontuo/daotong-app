<template>
    <div class="">
        <div class="row">
            <div class="col-md-4" v-for="calligraphy in calligraphys">
                <calligraphy-card
                    :calligraphy="calligraphy"
                ></calligraphy-card>
            </div>
        </div>
        <div class="mdui-valign mdui-m-b-1">
            <p class="mdui-center">
                <Button type="primary" :loading="loading" @click="toLoading" v-if="!this.noMoreData">
                    <span v-if="!loading">加载更多</span>
                    <span v-else>玩命加载中...</span>
                </Button>
                <span v-if="this.noMoreData">没有数据了~</span>
            </p>
        </div>
    </div>

</template>

<script>
    export default {
        data () {
            return {
                calligraphys: [],
                imgName: '',
                visible: false,
                loading: false,
                noMoreData: false,
                nextPageUrl: ''
            }
        },
        methods: {
            handleView(name) {
                this.imgName = name;
                this.visible = true;
            },
            toLoading() {
                this.loading = true;
                axios.get(this.nextPageUrl).then(response => {
                    this.calligraphys = this.calligraphys.concat(response.data.calligraphys.data);
                    if (!response.data.calligraphys.next_page_url) {
                        this.noMoreData = true;
                    }
                    this.nextPageUrl = response.data.calligraphys.next_page_url;
                    this.loading = false;
                });
            },
            show(id) {
                window.location.href = '/calligraphys/' + id;
            }
        },
        mounted() {
            axios.get('/api/calligraphys/calligraphyList').then(response => {
                console.log(response.data.calligraphys)
                this.calligraphys = response.data.calligraphys.data;
                this.nextPageUrl = response.data.calligraphys.next_page_url;
                if (!response.data.calligraphys.next_page_url) {
                    this.noMoreData = true;
                }
            });
        }
    }
</script>
<style>

</style>
