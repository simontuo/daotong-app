<template>
    <div>
        <div v-for="calligraphy in calligraphys" class="mdui-m-b-2">
            <Card >
                <p slot="title" @click="show(calligraphy.id)">
                    {{ calligraphy.title }}
                </p>
                <a href="#" slot="extra" @click.prevent="changeLimit">
                    作者：{{ calligraphy.user.name }}
                </a>
                <div class="demo-upload-list" v-for="item in calligraphy.images">
                    <img :src="item">
                    <div class="demo-upload-list-cover">
                        <Icon type="ios-eye-outline" @click.native="handleView(item)"></Icon>
                    </div>
                </div>
                <div class="row">
                    <span class="mdui-float-right article-card-icons mdui-m-x-1 mdui-text-color-teal"><i class="mdui-icon material-icons">&#xe0b9;</i>  {{ calligraphy.comments_count }}</span>
                    <span class="mdui-float-right article-card-icons mdui-m-x-1 mdui-card-header-subtitle"><i class="mdui-icon material-icons">&#xe87d;</i>  {{ calligraphy.likes.length }} </span>
                    <span class="mdui-float-right article-card-icons mdui-m-x-1 mdui-text-color-theme"><i class="mdui-icon material-icons">&#xe417;</i> {{ calligraphy.reads_count }} </span>
                </div>
            </Card>
        </div>
        <div class="mdui-valign mdui-m-b-1">
            <p class="mdui-center">
                <Button type="primary" :loading="loading" @click="toLoading" v-if="!this.noMoreData">
                    <span v-if="!loading">加载更多</span>
                    <span v-else>玩命加载中...</span>
                </Button>
                <span v-if="this.noMoreData">没有数据了~</span>
            </p>
        </div>
        <Modal title="查看图片" v-model="visible">
            <img :src="imgName" v-if="visible" style="width: 100%">
        </Modal>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                calligraphys: [],
                imgName: '',
                visible: false,
                loading: false,
                noMoreData: false,
            }
        },
        methods: {
            handleView(name) {
                this.imgName = name;
                this.visible = true;
            },
            toLoading() {

            },
            show(id) {
                window.location.href = '/calligraphys/' + id;
            }
        },
        mounted() {
            axios.get('/api/calligraphys/calligraphyList').then(response => {
                console.log(response.data.calligraphys.data)
                this.calligraphys = response.data.calligraphys.data;
            });
        }
    }
</script>
<style>
    .demo-upload-list{
        display: inline-block;
        width: 60px;
        height: 60px;
        text-align: center;
        line-height: 60px;
        border: 1px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        background: #fff;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,.2);
        margin-right: 4px;
    }
    .demo-upload-list img{
        width: 100%;
        height: 100%;
    }
    .demo-upload-list-cover{
        display: none;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,.6);
    }
    .demo-upload-list:hover .demo-upload-list-cover{
        display: block;
    }
    .demo-upload-list-cover i{
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        margin: 0 2px;
    }
</style>
