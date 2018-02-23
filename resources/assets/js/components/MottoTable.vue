<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <Button type="primary" @click="exportData()" class="mdui-m-b-1"><Icon type="ios-download-outline"></Icon> 导出数据</Button>
                <Select  class="mdui-m-b-1" v-model="quickQuery"  style="width:100px" @on-change="search">
                    <Option v-for="item in quickType" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
            </div>
            <div class="col-md-6">
                <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
                    <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
                    <input class="mdui-textfield-input" type="text" placeholder="模糊搜索标题或用户名" v-on:input="search" v-model="query"/>
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
                query: '',
                quickQuery: '',
                quickType: [
                    {
                        value: 0,
                        label: '最新问题'
                    },
                ],
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
                        title: '内容',
                        key: 'bio',
                        align: 'center',
                        ellipsis: 'true'
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
                                h('close-comment-button', {
                                    props: {
                                        model: params.row,
                                        type: 'mottoes'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                }),
                                h('is-hidden-button', {
                                    props: {
                                        model: params.row,
                                        type: 'mottoes'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                })
                            ]);
                        }
                    }
                ],
                data: []
            }
        },
        methods: {
            search () {
                axios.get('/api/admin/mottoes/search', {'params': {'query': this.query, 'quickQuery': this.quickQuery, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.mottoes.data;
                    this.total = parseInt(response.data.mottoes.total);
                    this.loading = false;
                });
            },
            changePage (page) {
                axios.get('/api/admin/mottoes/search', {params: {'query': this.query, 'quickQuery': this.quickQuery, 'page': page, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.mottoes.data;
                    this.total = parseInt(response.data.mottoes.total);
                    this.loading = false;
                });
            },
            pageSizeChange (pageSize) {
                this.pageSize = pageSize;
                axios.get('/api/admin/mottoes/search', {params: {'query': this.query, 'quickQuery': this.quickQuery, 'page': 1, 'pageSize': this.pageSize}}).then(response => {
                    this.data = response.data.mottoes.data;
                    this.total = parseInt(response.data.mottoes.total);
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
