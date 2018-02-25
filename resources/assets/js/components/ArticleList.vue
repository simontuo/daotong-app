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
            <div class="col-md-4 visible-xs" v-for="item in articles">
                <a :href="'/articles/' + item.id">
                    <article-card
                    :user="item.user"
                    :title="item.title"
                    :createdTime="item.created_time"
                    :readsCount="item.reads_count"
                    :commentsCount="item.comments_count"
                    :likesCount="item.likes.length"
                    :topics="item.topics"
                    ></article-card>
                </a>
            </div>

            <div class="col-md-12 mdui-m-b-2 hidden-xs">
                <ul class="media-list article-list">
                    <div class="article-list-hover">
                        <li class="media" style="margin-top: 0px;" v-for="item in articles">
                            <div class="media-left">
                                <a href="#">
                                    <Avatar size="large" :src="item.user.avatar" style="line-height:0px;margin-top:7px;" />
                                </a>
                            </div>
                            <div class="media-body">
                                <p class="media-heading mdui-typo mdui-typo-subheading" style="line-height:1">
                                    <a href="#" class="mdui-text-color-grey-800">{{ item.title }}</a>
                                    <span  v-for="topic in item.topics">
                                        <Tag checkable color="blue" size="small">{{ topic.name }}</Tag>
                                    </span>
                                    <span  v-if="item.topics.length == 0">
                                        <Tag checkable color="yellow" size="small">无Topic</Tag>
                                    </span>
                                </p>
                                <span class=" mdui-typo  mdui-typo-body-1">
                                    <a href="#" class="mdui-text-color-grey-500">{{ item.user.name }}</a>
                                </span>
                                <span class="mdui-text-color-grey-500 mdui-typo-body-1">
                                    - 创建于:{{ item.created_time }}
                                </span>
                                <span class="mdui-text-color-grey-500 mdui-typo-body-1">
                                    | 阅读:{{ item.reads_count }}
                                </span>
                                <span class="mdui-text-color-grey-500 mdui-typo-body-1">
                                    - 评论:{{ item.comments_count }}
                                </span>
                                <span class="mdui-text-color-grey-500 mdui-typo-body-1">
                                    - 点赞:{{ item.likes.length }}
                                </span>
                            </div>
                        </li>
                    </div>
                </ul>
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

<style>
    .article-list {
        background-color: #fff;
        border-radius: 3px;
    }
    .article-list li {
        padding: 5px 10px;
        border-bottom: 1px solid #e8eaf6;
    }
    .media:hover {
        border-bottom: 2px solid #2d8cf0;
    }
</style>
