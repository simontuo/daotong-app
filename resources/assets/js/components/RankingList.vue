<template>
    <div class="mdui-list mdui-shadow-1 mdui-m-b-2">
        <label>
            <div class="mdui-list-item-content mdui-m-x-2">
                <span>阅读量</span>
            </div>
        </label>
        <a :href="url + item.id" v-for="item in rankingList">
            <label class="mdui-list-item" >
                <div class="mdui-list-item-avatar"><img :src="item.user.avatar" /></div>
                <div class="mdui-list-item-content mdui-text-truncate">
                    <span>{{ item.title }}</span>
                </div>
                <span class="label label-success mdui-float-right">{{ item.reads_count }}</span>
            </label>
        </a>

        <div class="mdui-valign">
            <p class="mdui-center">
                <a @click="prevPage" v-if="prevPageUrl" class="mdui-icon material-icons">&#xe5cb;</i></a>
                <a @click="nextPage" v-if="nextPageUrl"><i class="mdui-icon material-icons">&#xe5cc;</i></a>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                url: '/articles/',
                rankingList: [],
                nextPageUrl: '',
                prevPageUrl: '',
            }
        },
        methods: {
            nextPage() {
                axios.get(this.nextPageUrl).then(resopnse => {
                    this.rankingList = resopnse.data.rankingList.data;
                    this.nextPageUrl = resopnse.data.rankingList.next_page_url;
                    this.prevPageUrl = resopnse.data.rankingList.prev_page_url;
                });
            },
            prevPage() {
                axios.get(this.prevPageUrl).then(resopnse => {
                    this.rankingList = resopnse.data.rankingList.data;
                    this.nextPageUrl = resopnse.data.rankingList.next_page_url;
                    this.prevPageUrl = resopnse.data.rankingList.prev_page_url;
                });
            },
        },
        mounted() {
            axios.get('/api/articles/rankingList').then(resopnse => {
                this.rankingList = resopnse.data.rankingList.data;
                this.nextPageUrl = resopnse.data.rankingList.next_page_url;
                this.prevPageUrl = resopnse.data.rankingList.prev_page_url;
            });
        }
    }
</script>

<style>
    .list-border {
        border-bottom: 1px solid #eee;
    }
</style>
