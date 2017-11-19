<template>
    <div class="">
        <div class="row">
            <div class="col-md-3" v-for="article in articles">
                <a :href="'/articles/' + article.id">
                    <article-card
                    :image="article.user.avatar"
                    :title="article.title"
                    :createdTime="article.created_time"
                    :readsCount="article.reads_count"
                    :commentsCount="article.comments_count"
                    :likesCount="article.likes.length"

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
