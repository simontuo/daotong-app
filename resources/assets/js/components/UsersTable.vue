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
                pageSizeOpts: [1, 2, 3, 5],
                total: 0,
                pageSize: 1,
                columns: [
                    {
                        type: 'selection',
                        width: 60,
                        align: 'center'
                    },
                    {
                        title: '名称',
                        key: 'name'
                    },
                    {
                        title: '邮箱',
                        key: 'email'
                    },
                    {
                        title: '手机',
                        key: 'phone'
                    },
                    {
                        title: '微信',
                        key: 'wechat'
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
            axios.get('/api/users/getUsers', {params: {'pageSize': this.pageSize}}).then(response => {
                this.data = response.data.users.data;
                this.total = parseInt(response.data.users.total);
                this.loading = false;
            });
        },
        methods: {
            changePage (page) {
                axios.get('/api/users/getUsers', {params: {'page': page, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.users.data;
                    this.total = parseInt(response.data.users.total);
                    this.loading = false;
                });
            },
            pageSizeChange (pageSize) {
                this.pageSize = pageSize;
                axios.get('/api/users/getUsers', {params: {'page': 1, 'pageSize': pageSize}}).then(response => {
                    this.data = response.data.users.data;
                    this.total = parseInt(response.data.users.total);
                    this.loading = false;
                });
            }
        }
    }
</script>
