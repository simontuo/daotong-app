<template>
    <div id="editor">
        <mavon-editor :ishljs = "true"
            ref="md"
            code_style="code-github"
            default_open="edit"
            :toolbars="toolbars"
            @imgAdd="$imgAdd"
            @imgDel="$imgDels"
        ></mavon-editor>
    </div>
</template>
<script>
    import { mavonEditor } from 'mavon-editor'
    import 'mavon-editor/dist/css/index.css'
    import 'mavon-editor/dist/js/hljs.cpp'
    import 'mavon-editor/dist/js/hljs.php'
    import 'mavon-editor/dist/js/hljs.xml'

    export default {
        data() {
            return {
                url: '/api/upload/image',
                img_file: {},
                toolbars: {
                    bold: true, // 粗体
                    italic: false, // 斜体
                    header: true, // 标题
                    underline: true, // 下划线
                    strikethrough: false, // 中划线
                    mark: true, // 标记
                    superscript: false, // 上角标
                    subscript: false, // 下角标
                    quote: true, // 引用
                    ol: true, // 有序列表
                    ul: true, // 无序列表
                    link: true, // 链接
                    imagelink: true, // 图片链接
                    code: true, // code
                    table: true, // 表格
                    fullscreen: true, // 全屏编辑
                    readmodel: false, // 沉浸式阅读
                    htmlcode: false, // 展示html源码
                    help: true, // 帮助
                    /* 1.3.5 */
                    undo: true, // 上一步
                    redo: true, // 下一步
                    trash: false, // 清空
                    save: false, // 保存（触发events中的save事件）
                    /* 1.4.2 */
                    navigation: false, // 导航目录
                    /* 2.1.8 */
                    alignleft: true, // 左对齐
                    aligncenter: true, // 居中
                    alignright: true, // 右对齐
                    /* 2.2.1 */
                    subfield: false, // 单双栏模式
                    preview: true, // 预览
                }
            }
        },
        components: {
            'mavon-editor': mavonEditor
        },
        methods: {
            $imgAdd(pos, $file){
                var $vm = this;
                var md = $vm.$refs.md;

                var formdata = new FormData();
                formdata.append('img', $file);
                axios({
                    url: '/upload',
                    method: 'post',
                    data: formdata,
                    headers: { 'Content-Type': 'multipart/form-data' },
                }).then(response => {

                    md.$refs.toolbar_left.$imgDelByFilename(pos)
                    md.$img2Url(pos, response.data.url)
                    md.$refs.toolbar_left.$imgAddByFilename(response.data.url)

                    pos = response.data.url;
                    this.img_file[pos] = $file;

                    this.$Message.success('上传图片成功！');
                })
            },
            $imgDels(pos){
                delete this.img_file[pos];
            },
        },
        mounted() {
            $('#editor').find('textarea').attr('name', 'bio');
        },
    }
</script>
<style>
    #editor {
        margin: auto;
        width: 100%;
    }
    .v-note-wrapper {
        z-index: 999 !important;
    }
    .v-note-wrapper.fullscreen {
        z-index: 1500 !important;
    }
</style>
