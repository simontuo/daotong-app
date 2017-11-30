<template>
    <div class="">
        <div class="row mdui-m-t-1">
            <div class="col-md-8">
                <Select v-model="quickQuery" size="large" style="width:100px" @on-change="search">
                    <Option v-for="item in quickType" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
            </div>
            <div class="col-md-4 mdui-m-b-1 pull-right">
                <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                    <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                    <input class="mdui-textfield-input" type="text" placeholder="模糊搜索标题或用户名" v-on:input="search" v-model="query"/>
                    <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4" v-for="article in articles">
                <a :href="'/articles/' + article.id">
                    <article-card
                    :user="article.user"
                    :title="article.title"
                    :createdTime="article.created_time"
                    :readsCount="article.reads_count"
                    :commentsCount="article.comments_count"
                    :likesCount="article.likes.length"
                    :topics="article.topics"
                    ></article-card>
                </a>
            </div>
        </div>
        <div class="row mdui-valign">
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
        data() {
            return {
                padding: 0,
                articles: [],
                loading: false,
                nextPageUrl: '',
                noMoreData: false,
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
            toLoading () {
                this.loading = true;
                axios.get(this.nextPageUrl).then(response => {
                    this.articles = this.articles.concat(response.data.articles.data);
                    if (!response.data.articles.next_page_url) {
                        this.noMoreData = true;
                    }
                    this.nextPageUrl = response.data.articles.next_page_url;
                    this.loading = false;
                });
            },
            search () {
                axios.get('api/articles/search', {'params': {'query': this.query, 'quickQuery': this.quickQuery}}).then(response => {
                    this.articles = response.data.articles.data;
                    if (!response.data.articles.next_page_url) {
                        this.noMoreData = true;
                    }
                    this.nextPageUrl = response.data.articles.next_page_url;
                    this.loading = false;
                });
            },
        }
    }
</script>
