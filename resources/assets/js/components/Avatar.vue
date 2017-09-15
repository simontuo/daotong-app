<template>
		
	<div class="mdui-card mdui-p-a-1 mdui-m-b-1 mdui-center">
        <img :src="imgDataUrl" class="mdui-img-fluid mdui-img-rounded mdui-center mdui-m-b-1" width="100" height="100">
        <button type="button" class="mdui-btn mdui-color-pink mdui-hoverable mdui-center mdui-m-b-1" @click="toggleShow">
                更换头像
        </button>
        <my-upload field="img"
	        @crop-success="cropSuccess"
	        @crop-upload-success="cropUploadSuccess"
	        @crop-upload-fail="cropUploadFail"
	        v-model="show"
			:width="300"
			:height="300"
			url="/upload"
			:params="params"
			:headers="headers"
			img-format="png">
		</my-upload>
	</div>

</template>

<script>
	import 'babel-polyfill'; // es6 shim
	import myUpload from 'vue-image-crop-upload';

    export default {
    	props: ['avatar', 'token'],
        data() {
        	return {
        		show: false,
				params: {
					_token: '123456798',
					name: 'avatar'
				},
				headers: {
					smail: '*_~'
				},
				imgDataUrl: this.avatar
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
				console.log('-------- crop success --------');
				this.imgDataUrl = imgDataUrl;
			},
			/**
			 * upload success
			 *
			 * [param] jsonData  server api return data, already json encode
			 * [param] field
			 */
			cropUploadSuccess(jsonData, field){
				console.log('-------- upload success --------');
				console.log(jsonData);
				console.log('field: ' + field);
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