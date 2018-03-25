<template>
    <div class="">
        <div class="row mdui-m-t-1 visible-xs">
            <div class="col-lg-6 ol-md-6 col-sm-3 col-xs-3">
                <Select v-model="quickQuery" size="large" style="width:100px" @on-change="search">
                    <Option v-for="item in quickType" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 mdui-m-b-1 pull-right">
                <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                    <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                    <input class="mdui-textfield-input" type="text" placeholder="模糊搜索标题或用户名" v-on:change="search" v-model="query"/>
                    <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 visible-xs">
                <poster-card></poster-card>
            </div>
            <div class="col-md-4 visible-xs" v-for="item in items">
                <a :href="'/' + item.type + '/' + item.id">
                    <item-card
                    :userId="item.user_id"
                    :userName="item.user_name"
                    :userAvatar="item.user_avatar"
                    :title="item.title"
                    :createdTime="item.created_time"
                    :readsCount="item.reads_count"
                    :commentsCount="item.comments_count"

                    :topics="item.topics"
                    ></item-card>
                </a>
            </div>

            <div class="col-md-9 mdui-m-b-2 hidden-xs">
                <ul class="media-list article-list mdui-m-y-1">
                    <div class="article-list-hover">
                        <li class="hidden-xs">
                            <div class="media-body">
                                <Button style="padding:6px 15px 6px 5px" type="text" @click="to('')">
                                    <span class="mdui-typo-subheading"><strong>全部</strong>
                                        <div class="list-bottom-border"></div>
                                    </span>
                                </Button>
                                <Button style="padding:6px 15px 6px 5px" type="text" @click="to('articles')">
                                    <span class="mdui-typo-subheading"><strong>文章</strong></span>
                                </Button>
                                <Button style="padding:6px 15px 6px 5px" type="text" @click="to('calligraphies')">
                                    <span class="mdui-typo-subheading"><strong>书法</strong></span>
                                </Button>
                                <Button style="padding:6px 15px 6px 5px" type="text" @click="to('questions')">
                                    <span class="mdui-typo-subheading"><strong>问答</strong></span>
                                </Button>

                                <div class="col-lg-6 col-md-6 col-sm-9 col-xs-9 pull-right">
                                    <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                                        <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                                        <input class="mdui-textfield-input" type="text" placeholder="按回车执行搜索" v-on:change="search" v-model="query"/>
                                        <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="media" style="margin-top: 0px;" v-for="item in items">
                            <div class="media-left">
                                <a :href="'/users/' + item.user_id + '/center'" class="like-avatar-lisl">
                                    <Avatar :src="item.user_avatar" class="like-avatar" style="line-height:0px;" />
                                </a>
                            </div>
                            <div class="media-body">
                                <p class="media-heading mdui-typo mdui-typo-subheading" style="line-height:1">
                                    <a :href="'/' + item.type + '/' + item.id" class="mdui-text-color-grey-800">{{ item.title }}</a>
                                </p>

                                <span class=" mdui-typo  mdui-typo-body-1">
                                    <Tag class="mdui-color-pink-accent" style="line-height:unset" size="small" v-if="item.type == 'questions'">问道</Tag>
                                    <Tag color="green" size="small" v-if="item.type == 'articles'">文章</Tag>
                                    <Tag color="yellow" size="small" v-if="item.type == 'calligraphies'">书法</Tag>
                                </span>
                                <span class="mdui-typo  mdui-typo-body-1">
                                    <a href="#" class="mdui-text-color-grey-500">{{ item.user_name }}</a>
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
                            </div>
                        </li>

                        <li class="hidden-xs" v-if="listLoading">
                            <div class="media-body">
                                <Spin fix>
                                    <Icon type="load-c" size=18 class="spin-icon-load"></Icon>
                                    <div>玩命加载中...</div>
                                </Spin>
                            </div>
                        </li>
                    </div>
                </ul>
                <div class="row mdui-valign" v-if="!listLoading">
                    <p class="mdui-center">
                        <Button type="primary" :loading="loading" @click="toLoading" v-if="!this.noMoreData">
                            <span v-if="!loading">加载更多</span>
                            <span v-else>玩命加载中...</span>
                        </Button>
                        <span v-if="this.noMoreData">没有数据了~</span>
                    </p>
                </div>
            </div>

            <div class="col-md-3 mdui-row-gapless mdui-m-b-2 hidden-xs">
                <hot-calligraphy-card></hot-calligraphy-card>
                <poster-card></poster-card>
                <motto-scroll></motto-scroll>
                <label-card></label-card>
            </div>
        </div>
        <div class="row mdui-valign mdui-hidden-sm-up">
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
                items: [],
                value: 0,
                show: true,
                loading: false,
                listLoading: true,
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
        mounted() {
            axios.get('api/index/search', {'params': {'query': this.query, 'quickQuery':            this.quickQuery}}).then(response => {
                this.items = response.data.items.data;
                if (!response.data.items.next_page_url) {
                    this.noMoreData = true;
                }
                this.nextPageUrl = response.data.items.next_page_url;
                this.loading = false;
                this.listLoading = false;
            });
        },
        methods: {
            toLoading () {
                this.loading = true;
                axios.get('/api/index/search' + this.nextPageUrl).then(response => {
                    this.items = this.items.concat(response.data.items.data);
                    if (!response.data.items.next_page_url) {
                        this.noMoreData = true;
                    }
                    this.nextPageUrl = response.data.items.next_page_url;
                    this.loading = false;
                });
            },
            search () {
                this.listLoading = true;
                axios.get('api/index/search', {'params': {'query': this.query, 'quickQuery':            this.quickQuery}}).then(response => {
                    this.items = response.data.items.data;
                    this.nextPageUrl = response.data.items.next_page_url;
                    if (!response.data.items.next_page_url) {
                        this.noMoreData = true;
                    }else {
                        this.noMoreData = false;
                    }

                    this.loading = false;
                    this.listLoading = false;
                });
            },
            to(path) {
                window.location.href = "/" + path;
            }
        }
    }
</script>

<style>
    .article-list {
        background-color: #fff;
        border-radius: 3px;
    }
    .article-list li {
        padding: 10px 0px 5px 10px;
        border-bottom: 1px solid #e8eaf6;
    }
    .media:hover {
        border-bottom: 2px solid #2d8cf0;
    }
    .like-avatar{
        background-color: #fff;
        border: 1px solid #ddd;
        width: 45px;
        height: 45px;
        border-radius: 45px;
    }
    .like-avatar img{
        margin: 4px;
        width: 35px;
        height: 35px;
        border-radius: 35px;
    }
    .spin-icon-load{
        animation: ani-demo-spin 1s linear infinite;
    }
    .list-bottom-border {
        border-bottom: 2px solid #ff9800;
        margin-top: 3px;
    }
</style>
