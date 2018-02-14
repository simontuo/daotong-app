<template>
    <div class="mdui-m-b-3">
        <Card dis-hover>
            <p slot="title">书法专栏: {{ calligraphys.length}}</p>
            <div class="media" v-for="item in calligraphys">
                <div class="media-body" style="border-bottom: 1px solid #f2f2f2;">
                    <div class="media-heading mdui-typo-subheading ">
                        <del v-if="item.is_hidden == 'T'">
                            <span class="mdui-typo"><a class="mdui-text-color-teal">{{ item.title }}</a></span>
                            <small class="mdui-text-color-grey-500">
                                {{ item.likes.length }} 点赞
                                <span> ⋅ </span>
                                {{ item.comments_count }} 评论
                                <span> ⋅ </span>
                                <span>{{ item.created_time }}</span>
                            </small>
                        </del>
                        <span v-if="item.is_hidden == 'F'">
                            <span class="mdui-typo"><a class="mdui-text-color-indigo">{{ item.title }}</a></span>
                            <small class="mdui-text-color-grey-500">
                                {{ item.likes.length }} 点赞
                                <span> ⋅ </span>
                                {{ item.comments_count }} 评论
                                <span> ⋅ </span>
                                <span>{{ item.created_time }}</span>
                            </small>
                        </span>
                        <Dropdown class="pull-right">
                            <Button type="text">
                                <Icon type="arrow-down-b"></Icon>
                            </Button>
                            <DropdownMenu slot="list">
                                <DropdownItem><span @click="showEdit(item.id)">编辑</span></DropdownItem>
                                <DropdownItem><span @click="showModal(item.id, item.is_hidden, type='hidden')">公开/隐藏</span></DropdownItem>
                                <DropdownItem><span @click="showModal(item.id, item.close_comment, type='closeComment')">关闭评论</span></DropdownItem>
                            </DropdownMenu>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </Card>
        <Modal v-model="modal" width="360">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon  type="information-circled"></Icon>
                <span v-if="modalType == 'hidden' && modalStatus == 'F'"> 屏蔽文章</span>
                <span v-if="modalType == 'hidden' && modalStatus == 'T'"> 公开文章</span>
                <span v-if="modalType =='closeComment' && modalStatus == 'F'"> 关闭评论</span>
                <span v-if="modalType == 'closeComment' && modalStatus == 'T'"> 打开评论</span>
            </p>
            <div style="text-align:center">
                <p v-if="modalType == 'hidden' && modalStatus == 'F'">屏蔽后其他用户将无法查看你的文章！</p>
                <p v-if="modalType == 'hidden' && modalStatus == 'T'">公开后所有的用户均可以查看你的文章！</p>
                <p v-if="modalType == 'closeComment' && modalStatus == 'F'">关闭评论后文章将无法评论！</p>
                <p v-if="modalType == 'closeComment' && modalStatus == 'T'">A打开评论后文章将恢复评论功能！</p>
                <p>你确定要这么做吗 ?</p>
            </div>
            <div slot="footer">
                <Button v-if="modalStatus == 'F'" type="error" size="large" long :loading="modalLoading" @click="sure">确认</Button>
                <Button v-if="modalStatus == 'T'" type="success" size="large" long :loading="modalLoading" @click="sure">确认</Button>
            </div>
        </Modal>
    </div>
</template>
<script>
    export default {
        props: ['user'],
        data () {
            return {
                calligraphys: [],
                modal: false,
                modalLoading: false,
                modalType: '',
                modalStatus: '',
                id: '',
            }
        },
        mounted () {
            axios.get('/api/calligraphys/' + this.user).then(response => {
                this.calligraphys = response.data.calligraphys;
            });
        },
        methods: {
            showEdit(id) {
                window.location.href = "/calligraphys/" + id + '/edit';
            },
            showModal(id, status, type) {
                this.modal      = true;
                this.modalType  = type;
                this.modalStatus = status;
                this.id = id;
            },
            sure () {
                this.modalLoading = true;
                if (this.modalType == 'hidden') {
                    axios.post('/api/calligraphys/' + this.id + '/isHidden').then(response => {
                        setTimeout(() => {
                            this.modalLoading = false;
                            this.modal = false;
                            if (response.data.state === 'T') {
                                this.$Message.success({content: "屏蔽成功！", duration: 2});
                            } else {
                                this.$Message.success({content: "公开成功！", duration: 2});
                            }
                        }, 1000);
                    }).catch(error => {
                        this.$Notice.info({
                            title: error.response.status,
                            desc: error.response.data.message,
                            duration: 2
                        });
                    });
                }

                if (this.modalType == 'closeComment') {
                    axios.post('/api/calligraphys/' + this.id + '/closeComment').then(response => {
                        setTimeout(() => {
                            this.modalLoading = false;
                            this.modal = false;
                            if (response.data.state === 'T') {
                                this.$Message.success({content: "关闭评论成功！", duration: 2});
                            } else {
                                this.$Message.success({content: "打开评论成功！", duration: 2});
                            }
                        }, 1000);
                    }).catch(error => {
                        this.$Notice.info({
                            title: error.response.status,
                            desc: error.response.data.message,
                            duration: 2
                        });
                    });
                }
            }
        }
    }
</script>
