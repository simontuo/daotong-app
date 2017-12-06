<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <Button type="primary" @click="exportData()" class="mdui-m-b-1"><Icon type="ios-download-outline"></Icon> 导出数据</Button>
            </div>
            <div class="col-md-6">
                <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                    <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                    <input class="mdui-textfield-input" type="text" placeholder="Search"/>
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
                columns: [
                    {
                        type: 'index',
                        width: 60,
                        align: 'center'
                    },
                    {
                        title: '名称',
                        key: 'name',
                        width: 120,
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
                                            this.show(params.index)
                                        }
                                    }
                                }, '查看'),
                                h('Button', {
                                    props: {
                                        type: 'warning',
                                        size: 'small'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.show(params.index)
                                        }
                                    }
                                }, '屏蔽'),
                                h('Button', {
                                    props: {
                                        type: 'error',
                                        size: 'small'
                                    },
                                    on: {
                                        click: () => {
                                            this.remove(params.index)
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
        mounted () {
            axios.get('/api/users/index', {params: {'pageSize': this.pageSize}}).then(response => {
                this.data = response.data.users.data;
                this.total = parseInt(response.data.users.total);
                this.loading = false;
            });
        },
        methods: {
            changePage (page) {
                axios.get('/api/users/index', {params: {'page': page, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.users.data;
                    this.total = parseInt(response.data.users.total);
                    this.loading = false;
                });
            },
            pageSizeChange (pageSize) {
                this.pageSize = pageSize;
                axios.get('/api/users/index', {params: {'page': 1, 'pageSize': pageSize}}).then(response => {
                    this.data = response.data.users.data;
                    this.total = parseInt(response.data.users.total);
                    this.loading = false;
                });
            }
        }
    }
</script>
