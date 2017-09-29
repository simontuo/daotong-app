<template>
    <Card>
        <p slot="title">
            评论数量：
        </p>
        <a slot="extra" @click="articleComment">
            <Icon type="chatbox-working"></Icon>
            评论
        </a>
        <ul class="media-list">
            <li class="media list-border">
                <div class="media-left">
                    <a href="#">
                        <Avatar class="like-avatar" src="https://i.loli.net/2017/08/21/599a521472424.jpg" />
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">simontuo <span class="pull-right conment-created-at" >1天前</span></h4>
                    不好意思打扰大家的时间线了，因为工作太忙，我已经很久没有在知乎活跃，没想到今天因为这么一件事重回到大家的视野中。在过去三年里，我和我们小团队，一直在埋头做一款叫『你今天真好看』的APP。关于我们创作它的故事，我之前的专栏里也有介绍，这里就不赘述了。写这篇文章，是因为我们遇上了一件很糟糕的事。太令人难以置信了，我自己连说出来都觉得心很累：阿里巴巴竟然以合作的名义，拿走了我们的技术方案，全盘抄袭了我们的APP。
                    <div class="mdui-btn-group mdui-m-y-1">
                        <button class="mdui-btn mdui-ripple mdui-color-blue-50 mdui-text-color-blue-800">
                            <i class="mdui-icon mdui-icon-left material-icons">&#xe8dc;</i>711
                        </button>
                        <button class="mdui-btn mdui-ripple" @click="listComment">
                            <i class="mdui-icon material-icons">&#xe15e;</i>
                            回复
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <div class="mdui-dialog" id="comment-list-dialog">
            <div class="mdui-dialog-title">回复：simontuo 评论</div>
            <div class="mdui-dialog-content">
                <div class="mdui-textfield">
                    <textarea class="mdui-textfield-input" placeholder="回复内容"></textarea>
                </div>
            </div>
            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple" mdui-dialog-cancel>取消</button>
                <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>评论</button>
            </div>
        </div>
        <div class="mdui-dialog" id="comment-article-dialog">
            <div class="mdui-dialog-title">回复：title 评论</div>
            <div class="mdui-dialog-content">
                <div class="mdui-textfield">
                    <textarea class="mdui-textfield-input" placeholder="回复内容"></textarea>
                </div>
            </div>
            <div class="mdui-dialog-actions">
                <button class="mdui-btn mdui-ripple" mdui-dialog-cancel>取消</button>
                <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>评论</button>
            </div>
        </div>
    </Card>

</template>
<script>
    export default {
        methods: {
            listComment () {
                var dialog = new mdui.Dialog('#comment-list-dialog');
                dialog.open();
            },
            articleComment () {
                var dialog = new mdui.Dialog('#comment-article-dialog');
                dialog.open();
            },

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
</style>
