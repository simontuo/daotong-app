<template>
    <div>
        <Upload
            :action="url"
            :headers="headers"
            :on-success="handleSuccess"
            :before-upload="beforeUpload"
            :show-upload-list='showUploadList'>
            <Button type="default" icon="ios-cloud-upload-outline" :loading="loading">
                <span v-if="!loading">上传</span>
                <span v-else>Loading...</span>
            </Button>
        </Upload>
    </div>

</template>
<script>
    export default {
        props: ['url', 'src'],
        data () {
            return {
                showUploadList: false,
                loading: false,
                headers: {
                    'Authorization': $('meta[name="api-token"]').attr('content')
                }
            }
        },
        methods: {
            beforeUpload () {
                this.loading = true;
            },
            handleSuccess (response) {
                console.log(response);
                if (this.src) {
                    $('.' + this.src).attr('src', response.url);
                    this.$Message.success({content: "上传成功！", duration: 2});
                }
                this.loading = false;
            }
        }
    }
</script>
