<template>
    <div mdui-tooltip="{content: '上传封面'}">
        <Upload
            type="drag"
            action="/api/upload/cover"
            :format="['jpg','jpeg','png']"
            :max-size="2048"
            :headers="headers"
            :on-format-error="handleFormatError"
            :on-exceeded-size="handleMaxSize"
            :on-success="handleSuccess"
            :on-error="handleError"
            :on-remove="handleRemove">
            <div style="padding: 20px 0">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                <p>点击或将文件拖拽到这里上传封面</p>
            </div>
        </Upload>
        <div class="">
            <input type="hidden" name="cover" v-model="cover">
            <img id="cover" class="mdui-img-fluid mdui-img-rounded" :src="url" alt="">
        </div>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                headers: {
                    Authorization: $('meta[name="api-token"]').attr('content')
                },
                url: '',
                cover: '',
            }
        },
        methods: {
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
            handleSuccess (response) {
                this.url   = response.url;
                this.cover = response.url;
                this.$Message.success('上传图片成功！');
            },
            handleError (response) {
                this.$Message.error('上传图片失败！');
            },
            handleRemove () {
                this.url   = '';
                this.cover = '';
            }
        }
    }
</script>
