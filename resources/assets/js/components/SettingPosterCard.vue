<template>
    <Card>
        <p slot="title">设置Poster</p>
        <Upload
            multiple
            type="drag"
            action="//jsonplaceholder.typicode.com/posts/">
            <div style="padding: 20px 0">
                <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                <p>Click or drag files here to upload</p>
            </div>
        </Upload>
        <Button type="text">应用</Button>
    </Card>
</template>

<script>
    export default {

    }
</script>
