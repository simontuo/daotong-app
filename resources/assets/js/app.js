
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
Vue.component('like-card', require('./components/LikeCard.vue'));
Vue.component('comment-list', require('./components/CommentList.vue'));
Vue.component('user-like-button', require('./components/UserLikeButton.vue'));
Vue.component('ranking-list', require('./components/RankingList.vue'));
Vue.component('user-follow-button', require('./components/UserFollowButton.vue'));
Vue.component('user-message-button', require('./components/UserMessageButton.vue'));
Vue.component('user-center-tab', require('./components/UserCenterTab.vue'));
Vue.component('new-user-follow-notification', require('./components/notifications/new_user_follow_notification.vue'));
Vue.component('user-comment-list', require('./components/UserCommentList.vue'));
Vue.component('user-message-list', require('./components/UserMessageList.vue'));
Vue.component('article-list', require('./components/ArticleList.vue'));
Vue.component('navbar-menu', require('./components/NavbarMenu.vue'));



const app = new Vue({
    el: '#app',
    data: {
        eventHub: new Vue()
    }
});
