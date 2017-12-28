<template>
    <div class="mdui-m-y-4">
        <Card style="border-radius:6px">
            <div>
                <img  :src="this.calligraphy.user.avatar" class="type-card-image mdui-shadow-1 mdui-hoverable mdui-m-l-2">
                <div class="pull-right mdui-m-r-2 type-card-title">
                    <span class="type-card-icons" mdui-tooltip="{content: '阅读量'}">
                        <Icon type="eye"></Icon>
                        {{ this.calligraphy.reads_count }}
                    </span>
                    <span class="type-card-icon" mdui-tooltip="{content: '总新建数'}">
                        <Icon type="ios-list"></Icon>
                        2
                    </span>
                    <span class="type-card-icon" mdui-tooltip="{content: '评论数'}">
                        <Icon type="android-chat" ></Icon>
                        {{ this.calligraphy.comments_count }}
                    </span>
                    <span class="type-card-icon" mdui-tooltip="{content: '点赞数'}">
                        <Icon type="thumbsup"></Icon>
                        {{ this.calligraphy.likes.length }}
                    </span>
                    <h3 class="mdui-m-t-1">{{ this.title }}</h3>
                </div>
                    <p class="mdui-m-t-2 type-card-subtitle">{{ this.calligraphy.title }}</p>
            </div>
            <div class="mdui-divider mdui-m-t-2  mdui-m-x-2"></div>
            <div class="mdui-m-a-2 mdui-valign">
                <div class="mdui-row-xs-3 mdui-grid-list mdui-center type-card-image-body">
                    <div class="mdui-col" v-for="item in this.calligraphy.images">
                        <div class="mdui-grid-tile">
                            <div class="demo-upload-list">
                                <img :src="item">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item)"></Icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdui-divider mdui-m-t-2  mdui-m-x-2"></div>
            <p class="mdui-m-t-2 type-card-subtitle"><a :href="'/calligraphys/' + calligraphy.id">{{ this.calligraphy.bio }}</a></p>

            <Modal title="查看图片" v-model="visible">
                <img :src="imgName" v-if="visible" style="width: 100%">
            </Modal>
        </Card>
    </div>
</template>
<script>
    export default {
        props: ['title', 'calligraphy', 'createdTime', 'readsCount', 'commentsCount', 'likesCount'],
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
    }
</script>

<style>
    .type-card-image {
        width: 50px;
        height: 50px;
        /*margin: -40px 20px 0 0;*/
        margin-top: -40px;
        border-radius: 6px;
        text-align: center;
    }
    .type-card-title {
        text-align: end;
    }
    .type-card-icon {
        color: #BDCDDE;
        margin-bottom: 0;
        margin-top: -5px;
        font-size: 13px;
    }
    .type-card-subtitle {
        color: #BDCDDE;
        margin-bottom: 0;
        font-weight: 400;
        text-align: center;
        font-size: 18px;
    }
    .type-card-footer {
        padding: 0px 0px 10px;
    }


    .demo-upload-list{
        display: inline-block;
        /* width: 60px; */
        /* height: 60px; */
        text-align: center;
        /* line-height: 60px; */
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
    .type-card-image-body{
        height: 100px;
        overflow: scroll;
    }
</style>
