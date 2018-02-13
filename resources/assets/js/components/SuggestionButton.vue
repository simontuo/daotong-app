<template>
    <span class="">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"  @click="modal = true"><i class="mdui-icon material-icons">&#xe156;</i></a>
        <Modal v-model="modal">
            <p slot="header" style="color:#3399ff;text-align:center;">
                <span>提交反馈</span>
            </p>
            <div>
                <Checkbox v-model="single">上传图片</Checkbox>
                <Upload
                    v-if="single"
                    multiple
                    type="drag"
                    action="//jsonplaceholder.typicode.com/posts/">
                    <div style="padding: 20px 0">
                        <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                        <p>Click or drag files here to upload</p>
                    </div>
                </Upload>
                <editor></editor>
            </div>
            <div slot="footer">
                <Button type="primary" size="large" :loading="modal_loading" @click="">提交</Button>
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
            }
        }
    }
</script>
