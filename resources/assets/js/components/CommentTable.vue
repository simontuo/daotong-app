<template>
    <div>
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
                        type: 'selection',
                        width: 60,
                        align: 'center'
                    },
                    {
                        type: 'index',
                        width: 60,
                        align: 'center'
                    },
                    {
                        title: '创建人',
                        key: 'user_id',
                    },
                    {
                        title: '内容',
                        key: 'bio'
                    },
                    {
                        title: 'Action',
                        key: 'action',
                        width: 150,
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
                                }, 'View'),
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
                                }, 'Delete')
                            ]);
                        }
                    }
                ],
                data: []
            }
        },
        mounted () {
            axios.get('/api/comments/index').then(response => {
                this.data = response.data.comments.data;
                this.total = parseInt(response.data.comments.total);
                this.loading = false;
            });
        },
        methods: {
            changePage (page) {
                axios.get('/api/comments/index', {params: {'page': page}}).then(response => {
                    this.data = response.data.comments.data;
                    this.total = parseInt(response.data.comments.total);
                    this.loading = false;
                });
            },
            pageSizeChange (pageSize) {
                this.pageSize = pageSize;
                axios.get('/api/comments/index', {params: {'page': 1}}).then(response => {
                    this.data = response.data.comments.data;
                    this.total = parseInt(response.data.comments.total);
                    this.loading = false;
                });
            }
        }
    }
</script>
