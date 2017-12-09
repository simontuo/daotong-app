<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <Button type="primary" @click="exportData()" class="mdui-m-b-1"><Icon type="ios-download-outline"></Icon> 导出数据</Button>
            </div>
            <div class="col-md-6">
                <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                    <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                    <input class="mdui-textfield-input" type="text" placeholder="模糊搜索标题或用户名" v-on:input="search" v-model="query"/>
                    <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
                </div>
            </div>
        </div>
        <Table border ref="selection" :columns="columns" :data="data" :loading="loading"></Table>
        <Page class="mdui-m-t-1 pull-right"
        @on-change="changePage"
        @on-page-size-change="pageSizeChange"
        :page-size-opts="pageSizeOpts"
        :total="total"
        show-total
        :page-size="pageSize"
        show-sizer></Page>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                loading: true,
                pageSizeOpts: [10, 20, 30, 50],
                total: 0,
                pageSize: 10,
                query: '',
                quickQuery: '',
                columns: [
                    {
                        type: 'index',
                        width: 60,
                        align: 'center'
                    },
                    {
                        title: '头像',
                        key: 'avatar',
                        width: 80,
                        align: 'center',
                        render: (h, params) => {
                            return h('div', [
                                h('Avatar', {
                                    props: {
                                        src: params.row.avatar
                                    }
                                })
                            ]);
                        }
                    },
                    {
                        title: '名称',
                        key: 'name',
                        width: 120,
                        align: 'center'
                    },
                    {
                        title: '注册时间',
                        key: 'created_at',
                        width: 150,
                        align: 'center'
                    },
                    {
                        title: '邮箱',
                        key: 'email',
                        width: 200,
                        align: 'center'
                    },
                    {
                        title: '手机',
                        key: 'phone',
                        width: 200,
                        align: 'center',
                    },
                    {
                        title: '微信',
                        key: 'wechat'
                    },
                    {
                        title: 'Action',
                        key: 'action',
                        width: 295,
                        align: 'center',
                        render: (h, params) => {
                            return h('div', [
                                h('Button', {
                                    props: {
                                        type: 'primary',
                                        size: 'small'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.show(params.row)
                                        }
                                    }
                                }, '查看'),
                                h('Button', {
                                    props: {
                                        type: 'warning',
                                        size: 'small',
                                        text: 'jinyan'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.banComment(params.row)
                                        }
                                    }
                                }, '禁言'),
                                h('Button', {
                                    props: {
                                        type: 'error',
                                        size: 'small'
                                    },
                                    on: {
                                        click: () => {
                                            this.remove(params.row)
                                        }
                                    }
                                }, '删除')
                            ]);
                        }
                    }
                ],
                data: []
            }
        },
        methods: {
            search () {
                axios.get('/api/users/search', {params: {'query': this.query, 'quickQuery': this.quickQuery, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.users.data;
                    this.total = parseInt(response.data.users.total);
                    this.loading = false;
                });
            },
            changePage (page) {
                axios.get('/api/users/search', {params: {'query': this.query, 'quickQuery': this.quickQuery, 'page': page, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.users.data;
                    this.total = parseInt(response.data.users.total);
                    this.loading = false;
                });
            },
            pageSizeChange (pageSize) {
                this.pageSize = pageSize;
                axios.get('/api/users/search', {params: {'query': this.query, 'quickQuery': this.quickQuery, 'page': 1, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.users.data;
                    this.total = parseInt(response.data.users.total);
                    this.loading = false;
                });
            },
            show (info) {
                console.log(info)
            },
            banComment (user) {
                axios.post('/api/users/' + user.id + '/banComment').then(response => {
                    if (response.data.state == 1) {
                        this.$Message.success({content: "禁言成功！", duration: 2});
                    } else {
                        this.$Message.success({content: "取消禁言成功！", duration: 2});
                    }
                });
            }
        }
    }
</script>
