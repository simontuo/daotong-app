<template>
    <div class="container">
        <div id="editor">
            <mavon-editor 
            	style="height: 100%"
				default_open = "edit"
				code_style = "code-hybrid"
            ></mavon-editor>
        </div>
    </div>
</template>


<script>
	import 'mavon-editor/dist/css/index.css'
    export default {
        name: 'editor',
        components: {
            'mavon-editor': mavonEditor.mavonEditor
        }
    }
</script>

<style>
    #editor {
        margin: auto;
        width: 80%;
        height: 580px;
    }

</style>