<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <Button type="primary" @click="exportData()" class="mdui-m-b-1"><Icon type="ios-download-outline"></Icon> 导出数据</Button>
                <Select  class="mdui-m-b-1" v-model="file"  style="width:100px" @on-change="search">
                    <Option v-for="item in files" :value="item" :key="item">{{ item }}</Option>
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
        <Table border ref="selection" :columns="columns" :data="data" :loading="loading"></Table>
        <Page class="mdui-m-t-1 pull-right"
        @on-change="changePage"
        @on-page-size-change="pageSizeChange"
        @on-row-click="rowDblclick"
        :page-size-opts="pageSizeOpts"
        :total="total"
        show-total
        highlight-row
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
                file: 'laravel.log',
                files: [],
                query: '',
                columns: [
                    {
                        type: 'index',
                        width: 60,
                        align: 'center'
                    },
                    {
                        title: 'Context',
                        width: 120,
                        key: 'context',
                        align: 'center'
                    },
                    {
                        title: 'Level',
                        width: 120,
                        key: 'level',
                        align: 'center'
                    },
                    {
                        title: 'Time',
                        width: 180,
                        key: 'date',
                        align: 'center'
                    },
                    {
                        title: 'Text',
                        key: 'text',
                        align: 'center',
                        ellipsis:'true'
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
        mounted() {
            axios.get('/api/admin/logs/getFiles').then(response => {
                this.files = this.files = response.data.files;
            });
        },
        methods: {
            search () {
                axios.get('/api/admin/logs/' + this.file + '/search', {params: {'page': 1, 'pageSize': this.pageSize, 'query': this.query}}).then(response => {
                    this.data = response.data.logs;
                    this.total = parseInt(response.data.total);
                    this.loading = false;
                    this.files = response.data.files
                });
            },
            changePage (page) {
                axios.get('/api/admin/logs/' + this.file + '/search', {params: {'page': page, 'pageSize': this.pageSize, 'query': this.query}}).then(response => {
                    this.data = response.data.logs;
                    this.total = parseInt(response.data.total);
                    this.loading = false;
                    this.files = response.data.files
                });
            },
            pageSizeChange (pageSize) {
                this.pageSize = pageSize;
                axios.get('/api/admin/logs/' + this.file + '/search', {params: {'page': 1, 'pageSize': this.pageSize, 'query': this.query}}).then(response => {
                    this.data = response.data.logs;
                    this.total = parseInt(response.data.total);
                    this.loading = false;
                    this.files = response.data.files
                });
            },
            rowDblclick (index) {
                console.log(index);
            }
        }
    }
</script>
