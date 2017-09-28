
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueSimplemde = require('vue-simplemde');
window.iView = require('iview');
window.VueQuillEditor = require('vue-quill-editor');
window.hljs = require('highlight');
window.mavonEditor = require('mavon-editor');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('avatar', require('./components/Avatar.vue'));
Vue.component('editor', require('./components/Editor.vue'));
Vue.component('cover', require('./components/Cover.vue'));
Vue.component('test', require('./components/Test.vue'));
Vue.component('alert', require('./components/Alert.vue'));
Vue.component('back-top', require('./components/BackTop.vue'));



const app = new Vue({
    el: '#app',
    data: {
        eventHub: new Vue()
    }
});
