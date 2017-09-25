<style>
	.vicp-wrap{
		width: 300px;
		height: 500px;
	}

</style>

<template>
	<div class="mdui-card mdui-p-a-1 mdui-m-b-1 mdui-center">
		<my-upload field="img"
	        @crop-success="cropSuccess"
	        @crop-upload-success="cropUploadSuccess"
	        @crop-upload-fail="cropUploadFail"
	        v-model="show"
			:width="150"
			:height="150"
			url="/url"
			:params="params"
			:headers="headers"
			img-format="png"></my-upload>
	</div>

</template>


<script>
	import 'babel-polyfill'; // es6 shim
	import myUpload from 'vue-image-crop-upload';

    export default {
        data() {
        	return {
        		show: false,
				params: {
					_token: '1',
					name: 'img'
				},
				headers: {
					smail: '*_~'
				}

        	}
		},
		components: {
			'my-upload': myUpload
		},
		methods: {
			toggleShow() {
				this.show = !this.show;
			},
            /**
			 * crop success
			 *
			 * [param] imgDataUrl
			 * [param] field
			 */
			cropSuccess(imgDataUrl, field){
				this.imgDataUrl = imgDataUrl;
			},
			/**
			 * upload success
			 *
			 * [param] jsonData  server api return data, already json encode
			 * [param] field
			 */
			cropUploadSuccess(response, field){
				$('#user-avatar').attr('src', response.url);
			},
			/**
			 * upload fail
			 *
			 * [param] status    server api return error status, like 500
			 * [param] field
			 */
			cropUploadFail(status, field){
				console.log('-------- upload fail --------');
				console.log(status);
				console.log('field: ' + field);
			}
		}
    }
</script>
