<style>
    .editor-toolbar.fullscreen {
        z-index: 9999;
    }
    .CodeMirror-fullscreen {
        z-index: 9999;
    }
</style>
<template>
    <div>
        <markdown-editor
            :highlight="true"
            preview-class="markdown-body"
            :configs="configs"
        ></markdown-editor>
        <avatar></avatar>
    </div>
</template>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor';
    import 'babel-polyfill'; // es6 shim

    export default {
        data() {
            return {
                configs: {
                    autofocus: true,
                    toolbar: ['bold', 'italic', 'strikethrough', '|','heading-1', 'heading-2', 'heading-3', '|', 'code', 'quote', 'unordered-list', 'ordered-list', 'clean-block', 'link', 'image', 'table', 'horizontal-rule', '|', 'preview', 'side-by-side', 'fullscreen', 'guide',
                    {
                        name: "upload-image",
            			action: function uploadImage (editor) {
                            console.log(1);
                        },
            			className: "fa fa-picture-o",
            			title: "上传图片",
                    }
                    ],

                }
            }
        },
        components: {
            markdownEditor
        },
        methods: {
            show(editor) {
                console.log(editor);
            }
        }
    }
</script>
