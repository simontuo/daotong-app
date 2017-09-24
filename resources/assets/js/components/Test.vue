<style>
    .cover{
        height: 200px;
        background-color: #eee;
    }
</style>

<template>
    <div class="cover mdui-valign" mdui-tooltip="{content: '上传封面'}">
        <my-upload field="img"
            @crop-success="cropSuccess"
            @crop-upload-success="cropUploadSuccess"
            @crop-upload-fail="cropUploadFail"
            v-model="show"
            :width="150"
            :height="150"
            :url="url"
            :params="params"
            :headers="headers"
            img-format="png"></my-upload>
        <button type="button" class="mdui-btn mdui-color-theme mdui-ripple mdui-center mdui-hoverable"><i class="mdui-icon material-icons mdui-center" @click="toggleShow">add</i></button>
    </div>

</template>

<script>
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload';

    export default {
        props: ['cover'],
        data() {
        	return {
        		show: false,
				params: {
					_token: '123',
					name: 'img'
				},
				headers: {
					smail: '*_~'
				},
                imgDataUrl: this.cover,
				url: '/users/'
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
