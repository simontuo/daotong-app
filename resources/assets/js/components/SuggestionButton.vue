<template>
    <span class="">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"  @click="modal = true"><i class="mdui-icon material-icons">&#xe156;</i></a>
        <Modal v-model="modal">
            <p slot="header" style="color:#3399ff;text-align:center;">
                <span>提交反馈</span>
            </p>
            <Checkbox v-model="single">上传图片</Checkbox>
            <form id="suggestionForm" action="/suggestions" method="post">
                <input type="hidden" name="_token" :value="token">
                <div class="">
                    <div v-if="single">
                        <div class="demo-upload-list" v-for="item in uploadList">
                            <template v-if="item.status === 'finished'">
                                <img :src="item.url">
                                <div class="demo-upload-list-cover">
                                    <Icon type="ios-eye-outline" @click.native="handleView(item.name)"></Icon>
                                    <Icon type="ios-trash-outline" @click.native="handleRemove(item)"></Icon>
                                </div>
                            </template>
                            <template v-else>
                                <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
                            </template>
                        </div>
                        <input type="hidden" name="images[]" v-for="item in uploadList" :value="item.url">
                        <Upload
                            ref="upload"
                            :headers="headers"
                            :show-upload-list="false"
                            :default-file-list="images"
                            :on-success="handleSuccess"
                            :format="['jpg','jpeg','png']"
                            :max-size="2048"
                            :on-format-error="handleFormatError"
                            :on-exceeded-size="handleMaxSize"
                            :before-upload="handleBeforeUpload"
                            multiple
                            type="drag"
                            action="/api/upload/listImage"
                            style="display: inline-block;width:58px;">
                            <div style="width: 58px;height:58px;line-height: 58px;">
                                <Icon type="camera" size="20"></Icon>
                            </div>
                        </Upload>
                        <Modal title="查看图片" v-model="visible">
                            <img :src="imgName" v-if="visible" style="width: 100%">
                        </Modal>
                    </div>
                    <editor></editor>
                </div>
            </form>

            <div slot="footer">
                <Button type="primary" size="large" :loading="modal_loading" @click="submit">提交</Button>
            </div>
        </Modal>
    </span>

</template>

<script>
    export default {
        data() {
            return {
                modal: false,
                modal_loading: false,
                single: true,

                headers: {
                    Authorization: $('meta[name="api-token"]').attr('content')
                },
                defaultList: [],
                imgName: '',
                visible: false,
                uploadList: [],
                url: [],
                token: $('meta[name="csrf-token"]').attr('content')
            }
        },
        methods: {
            handleView (name) {
                this.imgName = name;
                this.visible = true;
            },
            handleRemove (file) {
                // 从 upload 实例删除数据
                const fileList = this.$refs.upload.fileList;
                this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
            },
            handleSuccess (res, file) {
                // 因为上传过程为实例，这里模拟添加 url
                file.url = res.url;
                file.name = res.url;
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: '文件格式不正确',
                    desc: '文件 ' + file.name + ' 格式不正确，请上传 jpg 或 png 格式的图片。'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: '超出文件大小限制',
                    desc: '文件 ' + file.name + ' 太大，不能超过 2M。'
                });
            },
            handleBeforeUpload () {
                const check = this.uploadList.length < 5;
                if (!check) {
                    this.$Notice.warning({
                        title: '最多只能上传 5 张图片。'
                    });
                }
                return check;
            },
            submit() {
                event.preventDefault();
                document.getElementById('suggestionForm').submit();
            }
        },
        mounted () {
            this.uploadList = this.$refs.upload.fileList;
        },
        computed: {
            images() {
                if (this.calligraphy) {
                    for (var i = 0; i < JSON.parse(this.calligraphy).images.length; i++) {
                        this.defaultList.push({
                            'name': JSON.parse(this.calligraphy).images[i],
                            'url': JSON.parse(this.calligraphy).images[i]
                        })
                    }
                    console.log(this.defaultList);
                    return this.defaultList;
                }
                return this.defaultList = [];
            }
        },
    }
</script>

<style>
    .img-responsive {
        display: inline-block;
        height: auto;
        max-width: 100%;
    }
</style>
