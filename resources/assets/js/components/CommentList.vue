<template>
    <Card>
        <p slot="title">
            评论数量：{{ count }}
        </p>
        <a slot="extra" @click="articleComment">
            <Icon type="chatbox-working"></Icon>
            评论
        </a>
        <!-- 评论列表 -->
        <div style="text-align: center;" v-if="count < 1 && !spinShow">
            <p class="mdui-text-color-theme-accent"><i class="mdui-icon material-icons">&#xe811;</i> 暂无评论</p>
        </div>
        <div class="spin-container mdui-center" v-if="spinShow">
            <Spin size="large" fix v-if="spinShow"></Spin>
        </div>
        <ul class="media-list" v-if="count > 0 && !spinShow">
            <li class="media list-border" v-for="comment in comments">
                <div class="media-left">
                    <a href="#">
                        <Avatar class="like-avatar" :src="comment.user.avatar" />
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ comment.user.name }}
                        <span class="pull-right conment-created-at" >{{ comment.created_time }}</span>
                    </h4>
                    <p>
                        <span v-if="comment.parent">
                            <a href="#"><strong><Icon type="at"></Icon> {{ comment.parent.name }} : </strong></a>
                        </span>
                        {{ comment.bio }}
                    </p>
                    <div class="mdui-btn-group mdui-m-y-1">
                        <button class="mdui-btn mdui-ripple" @click="listComment(comment.user.id)">
                            <i class="mdui-icon material-icons">&#xe15e;</i>
                            回复
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <!-- 评论dialog -->
        <div class="mdui-dialog" :id="dialog">
            <div class="mdui-dialog-title">回复：simontuo 评论</div>
            <div class="mdui-dialog-content">
                <div class="mdui-textfield">
                    <textarea class="mdui-textfield-input" v-model="bio" placeholder="回复内容"></textarea>
                </div>
            </div>
            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple" mdui-dialog-confirm @click="comment()">评论</button>
                <button class="mdui-btn mdui-ripple" mdui-dialog-cancel @click="emptyTextarea">取消</button>
            </div>
        </div>
        <div class="mdui-dialog" id="comment-article-dialog">
            <div class="mdui-dialog-title">评论：{{ title }} </div>
            <div class="mdui-dialog-content">
                <div class="mdui-textfield">
                    <textarea class="mdui-textfield-input" v-model="bio" placeholder="评论内容"></textarea>
                </div>
            </div>
            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple" mdui-dialog-confirm @click="comment()">评论</button>
                <button class="mdui-btn mdui-ripple" mdui-dialog-cancel @click="emptyTextarea">取消</button>
            </div>
        </div>
    </Card>

</template>
<script>
    export default {
        props: ['model', 'type', 'title'],
        data () {
            return {
                bio: '',
                count: 0,
                spinShow: false,
                comments: [],
                parentId: 0,
            }
        },
        computed: {
            dialog () {
                return 'comments-dialog-' + this.type + '-';
            },
            dialogId () {
                return '#' + this.dialog;
            },
        },
        methods: {
            listComment (userId) {
                $('#' + this.dialog).attr('id', this.dialog + userId);
                this.parentId = userId;
                this.show(this.dialogId + userId);
            },
            articleComment () {
                this.parentId = 0;
                this.show('#comment-article-dialog');
            },
            comment () {
                axios.post('/api/comments/store', {'parentId': this.parentId, 'bio': this.bio, 'type': this.type, 'model': this.model}).then(response => {
                    if (!response.data.status) {
                        this.$Message.error({content: response.data.message, duration: 4});
                    } else {
                        this.count ++;
                        this.comments.push(response.data.comment);
                        this.$Message.success({content: response.data.message, duration: 2});
                    }
                }).catch(error => {
                    if (error.response.status == 401) {
                        this.showNote(error);
                    }
                });
                this.bio = '';
            },
            emptyTextarea () {
                this.bio = '';
            },
            show (modal) {
                var dialog = new mdui.Dialog(modal);
                dialog.open();
            },
            showNote(error) {
                this.$Notice.info({
                    title: '请先登录再进行相关操作！',
                    desc: error.response.data.message,
                    duration: 2
                });
            }
        },
        mounted() {
            axios.get('/api/comments/' + this.type + '/' + this.model).then(response => {
                this.count = response.data.comments.length;
                if (this.count > 0) {
                    this.comments = response.data.comments;
                }
                this.spinShow = false;
            })
        }
    }
</script>
<style>
    .list-border {
        border-bottom: 1px solid #eee;
    }
    .conment-created-at {
        font-size: 12px;
    }
    .spin-container{
    	display: inline-block;
        width: 50px;
        height: 50px;
        position: relative;
    }
</style>
