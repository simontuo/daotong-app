<template>
    <div mdui-tooltip="{content: '上传封面'}">
        <Upload
            multiple
            type="drag"
            action="/api/upload"
            :on-success="handleSuccess"
            :on-error="handleError"
            :data="data"
            :headers="headers"
            >
            <div style="padding: 20px 0">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                <p>点击或将文件拖拽到这里上传封面</p>
            </div>
        </Upload>
    </div>

</template>
<script>
    export default {
        props: ['api_token'],
        data() {
            return {
                data: {
                    _token: '123'
                },
                headers: {
                    Authorization: this.api_token
                }
            }
        },
        methods: {
            handleSuccess (response) {
                this.$Message.success('上传图片成功！');
            },
            handleError (response) {
                this.$Message.error('上传图片失败！');
            }
        }
    }
</script>
<style>
    .ivu-upload{
        /*background-color: #eee;*/
    }
</style>
