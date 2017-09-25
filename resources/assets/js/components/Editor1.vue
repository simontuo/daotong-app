<style>
    .wangEditor-container{
        font-size: 20px;
    }
</style>
<template>
    <div>
       
        <vue-wangeditor id="editor" v-model="text"
            width="100%"
            uploadImgUrl="/test"
            hideLinkImg="true"
            value="editor"
        ></vue-wangeditor>
        <input type="hidden" name="test" v-model="text">
    </div>
</template>

<script>
    import vueWangeditor from 'vue-wangeditor'
    export default {
        data() {
            return {
                text: '12'
            }
        },
        components: {
            vueWangeditor
        }
    }
</script>
