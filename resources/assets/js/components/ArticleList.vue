<template>
    <div class="">
        <div class="row">
            <div class="col-md-3" v-for="article in articles">
                <a href="/">
                    <article-card
                    :image="article.user.avatar"
                    :title="article.title"
                    :createdTime="article.created_time"
                    ></article-card>
                </a>
            </div>
            <!-- <Card :padding="padding">
                <ul class="mdui-list">
                    <a :href="'/articles/' + article.id" v-for="article in articles">
                        <li class="mdui-list-item mdui-ripple list-border">
                            <div class="mdui-list-item-avatar"><img :src="article.user.avatar"/></div>
                            <div class="mdui-list-item-content mdui-text-truncate">
                                <span class="label label-info">文章</span> {{ article.title }}
                            </div>
                            <span class="pull-right mdui-m-l-1 mdui-text-color-theme-accent" mdui-tooltip="{content: '点赞数'}">{{ article.likes.length }}</span>
                            <span class="pull-right mdui-m-l-1 mdui-card-header-subtitle">/</span>
                            <span class="pull-right mdui-m-l-1 mdui-card-header-subtitle" mdui-tooltip="{content: '评论数'}">{{ article.comments_count }}</span>
                            <span class="pull-right mdui-m-l-1 mdui-card-header-subtitle">/</span>
                            <span class="pull-right mdui-m-l-1 mdui-card-header-subtitle" mdui-tooltip="{content: '阅读量'}">{{ article.reads_count }}</span>
                            <span class="pull-right mdui-m-l-1 mdui-card-header-subtitle">|</span>
                            <span class="pull-right mdui-m-l-1 mdui-card-header-subtitle">{{ article.created_time }}</span>
                        </li>
                    </a>
                </ul>
                <div class="mdui-valign mdui-m-b-1">
                    <p class="mdui-center">
                        <Button type="primary" :loading="loading" @click="toLoading" v-if="!this.noMoreData">
                            <span v-if="!loading">加载更多</span>
                            <span v-else>玩命加载中...</span>
                        </Button>
                        <span v-if="this.noMoreData">没有数据了~</span>
                    </p>
                </div>
            </Card> -->
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
            }
        },
        mounted() {
            axios.get('/api/articles/articleList').then(response => {
                this.articles = response.data.articles.data;
                this.nextPageUrl = response.data.articles.next_page_url;
                if (!response.data.articles.next_page_url) {
                    this.noMoreData = true;
                }
            });
        },
        methods: {
            toLoading () {
                this.loading = true;
                axios.get(this.nextPageUrl).then(response => {
                    this.articles = this.articles.concat(response.data.articles.data);
                    console.log(response.data.articles.next_page_url)
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
