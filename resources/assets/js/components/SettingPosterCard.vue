<template>
    <Card>
        <p slot="title">设置Poster</p>
        <Upload
            multiple
            :headers="headers"
            :on-success="handleSuccess"
            type="drag"
            action="/api/upload/poster">
            <div style="padding: 20px 0">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                <p>Click or drag files here to upload</p>
            </div>
        </Upload>
        <form id="poster-form" action="/admin/settings/uploadPoster" method="post">
            <input type="hidden" name="_token" :value="this.token"/>
            <input type="hidden" name="poster" :value="this.poster">
            <Input name="poster_bio" placeholder="输入描述" ></Input>
            <Button type="text" onclick="event.preventDefault();
            document.getElementById('poster-form').submit();">应用</Button>
        </form>

    </Card>
</template>

<script>
    export default {
        data() {
            return {
                headers: {
                    Authorization: $('meta[name="api-token"]').attr('content')
                },
                token: $('meta[name="csrf-token"]').attr('content'),
                poster: ''
            }
        },
        methods: {
            handleSuccess (res, file) {
                // 因为上传过程为实例，这里模拟添加 url
                this.poster = res.url;
            },
        }
    }
</script>
