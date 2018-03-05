<template>
    <div class="">
        <div class="row mdui-m-t-1">
            <div class="col-lg-6 ol-md-6 col-sm-3 col-xs-3">
                <Select v-model="quickQuery" size="large" style="width:100px" @on-change="search">
                    <Option v-for="item in quickType" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9 mdui-m-b-1 pull-right">
                <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                    <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                    <input class="mdui-textfield-input" type="text" placeholder="模糊搜索标题或用户名" v-on:input="search" v-model="query"/>
                    <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" v-for="calligraphy in this.calligraphies">
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
                calligraphies: [],
                imgName: '',
                visible: false,
                loading: false,
                noMoreData: false,
                nextPageUrl: '',
                query: '',
                quickQuery: '',
                quickType: [
                    {
                        value: 0,
                        label: '最新文章'
                    },
                    {
                        value: 1,
                        label: '热门文章'
                    },
                    {
                        value: 2,
                        label: '评论最多'
                    },
                    {
                        value: 4,
                        label: '点赞最多'
                    },
                ]
            }
        },
        methods: {
            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            toLoading () {
                this.loading = true;
                axios.get(this.nextPageUrl).then(response => {
                    this.calligraphies = this.calligraphies.concat(response.data.calligraphies.data);
                    if (!response.data.calligraphies.next_page_url) {
                        this.noMoreData = true;
                    }
                    this.nextPageUrl = response.data.calligraphies.next_page_url;
                    this.loading = false;
                });
            },
            show (id) {
                window.location.href = '/calligraphies/' + id;
            },
            search () {
                axios.get('/api/calligraphies/search', {'params': {'query': this.query, 'quickQuery': this.quickQuery}}).then(response => {
                    console.log(response.data.calligraphies.data)
                    this.calligraphies = response.data.calligraphies.data;
                    this.nextPageUrl = response.data.calligraphies.next_page_url;
                    if (!response.data.calligraphies.next_page_url) {
                        this.noMoreData = true;
                    }
                });
            }
        },
        mounted() {
            // axios.get('/api/calligraphies/calligraphyList').then(response => {
            //     console.log(response.data.calligraphies)
            //     this.calligraphies = response.data.calligraphies.data;
            //     this.nextPageUrl = response.data.calligraphies.next_page_url;
            //     if (!response.data.calligraphies.next_page_url) {
            //         this.noMoreData = true;
            //     }
            // });
        }
    }
</script>
<style>

</style>
