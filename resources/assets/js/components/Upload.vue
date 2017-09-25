<style>
    .editor-toolbar.fullscreen {
        z-index: 5999;
    }
    .CodeMirror-fullscreen {
        z-index: 5999;
    }
    .editor-preview-side {
        z-index: 5999;
    }
</style>
<template>
    <div id="MyID">
        <markdown-editor
            :highlight="true"
            preview-class="markdown-body"
            :configs="configs">
            <textarea name="bio" id="bio"></textarea>
        </markdown-editor>
    </div>
</template>

<script>
    import markdownEditor from 'vue-simplemde/src/markdown-editor';
    import 'babel-polyfill'; // es6 shim

    export default {
        data() {
            return {
                configs: {
                    forceSync:true,
                    autofocus: true,
                    toolbar: ['bold', 'italic', 'strikethrough', '|','heading-1', 'heading-2', 'heading-3', '|', 'code', 'quote', 'unordered-list', 'ordered-list', 'clean-block', 'link', 'image', 'table', 'horizontal-rule', '|', 'preview', 'side-by-side', 'fullscreen', 'guide',
                    {
                        name: "upload-image",
            			action: function uploadImage (editor) {

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

        }
    }
</script>
