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
        <Table border ref="table" :columns="columns" :data="data" :loading="loading"></Table>
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
                        title: '创建人',
                        width: 120,
                        key: 'user_name',
                        align: 'center'
                    },
                    {
                        title: '标题',
                        key: 'title',
                        align: 'center'
                    },
                    {
                        title: '阅读量',
                        width: 80,
                        key: 'reads_count',
                        align: 'center'
                    },
                    {
                        title: '评论数',
                        width: 80,
                        key: 'comments_count',
                        align: 'center'
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
            axios.get('/api/articles/index').then(response => {
                this.data = response.data.articles.data;
                this.total = parseInt(response.data.articles.total);
                this.loading = false;
            });
        },
        methods: {
            changePage (page) {
                axios.get('/api/articles/index', {params: {'page': page}}).then(response => {
                    this.data = response.data.articles.data;
                    this.total = parseInt(response.data.articles.total);
                    this.loading = false;
                });
            },
            pageSizeChange (pageSize) {
                this.pageSize = pageSize;
                axios.get('/api/articles/index', {params: {'page': 1}}).then(response => {
                    this.data = response.data.articles.data;
                    this.total = parseInt(response.data.articles.total);
                    this.loading = false;
                });
            },
            exportData () {
                this.$refs.table.exportCsv({
                    filename: 'The original data'
                });
            }
        }
    }
</script>
