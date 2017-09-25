<style>
	.markdown-body .highlight pre, .markdown-body pre {
		background:#d9edf7;
	}
</style>
<template>
    <div>
        <markdown-editor 
        	preview-class="markdown-body" 
        	:highlight="true" 
        	:configs="configs"
        ></markdown-editor>

        <checkbox></checkbox>
        <upload-image token="123" url="/stest"></upload-image>
    </div>
</template>


<script>
	import markdownEditor from 'vue-simplemde/src/markdown-editor';

    export default {
		data () {
		    return {
		      	configs: {
		      		// promptURLs: true,
					 toolbar: [
					 'image','preview','link',
			          {
			            name: 'custom',
			            action: function (editor){

			            	console.log(22);
			            },
			            className: 'fa fa-picture-o',
			            title: '自定义按钮'
			          },
			          {
			            name: 'link',
			            action: function customFunction (editor) {
			            	editor.options.insertTexts.link[1] = ']' + '(' + "http://photo.maguas.com//avatars/8cb376287b77f876e02776ab1e5f5da7.png" + ')';
			            	editor.drawLink();
			            
			            },
			            className: 'fa fa-link',
			            title: '自定义临街'
			          },
			        ]

		      	}
		    }
		 },
		components: {
			'markdown-editor':markdownEditor
		},
		methods: {
			toggleShows () {
				console.log(2);
			}
		}
	}
</script>

