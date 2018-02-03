
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
// window.vSelect = require('vue-select');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('avatar', require('./components/Avatar.vue'));
Vue.component('avatar-upload', require('./components/AvatarUpload.vue'));
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
Vue.component('new-message-notification', require('./components/notifications/new_message_notification.vue'));
Vue.component('user-comment-list', require('./components/UserCommentList.vue'));
Vue.component('user-message-list', require('./components/UserMessageList.vue'));
Vue.component('article-list', require('./components/ArticleList.vue'));
Vue.component('navbar-menu', require('./components/NavbarMenu.vue'));
Vue.component('upload-img-list', require('./components/UploadImgList.vue'));
Vue.component('upload-img-button', require('./components/UploadImageButton.vue'));
Vue.component('calligraphy-list', require('./components/CalligraphyList.vue'));
Vue.component('badge', require('./components/Badge.vue'));
Vue.component('search-input', require('./components/SearchInput.vue'));
Vue.component('messages-list', require('./components/MessagesList.vue'));
Vue.component('message-dialog', require('./components/MessageDialog.vue'));
Vue.component('topics', require('./components/Topics.vue'));
Vue.component('ban-comment-button', require('./components/BanCommentButton.vue'));
Vue.component('ban-login-button', require('./components/BanLoginButton.vue'));
Vue.component('close-comment-button', require('./components/CloseCommentButton.vue'));
Vue.component('is-hidden-button', require('./components/IsHiddenButton.vue'));
Vue.component('bread-crumb', require('./components/BreadCrumb.vue'));
Vue.component('user-article-card', require('./components/UserArticleCard.vue'));
Vue.component('user-comment-card', require('./components/UserCommentCard.vue'));
Vue.component('user-calligraphy-card', require('./components/UserCalligraphyCard.vue'));


Vue.component('user-table', require('./components/UserTable.vue'));
Vue.component('article-table', require('./components/ArticleTable.vue'));
Vue.component('calligraphy-table', require('./components/CalligraphyTable.vue'));
Vue.component('comment-table', require('./components/CommentTable.vue'));
Vue.component('message-table', require('./components/MessageTable.vue'));
Vue.component('log-table', require('./components/LogTable.vue'));

Vue.component('type-card', require('./components/TypeCard.vue'));
Vue.component('article-card', require('./components/ArticleCard.vue'));
Vue.component('calligraphy-card', require('./components/CalligraphyCard.vue'));

Vue.component('question-list', require('./components/QuestionList.vue'));
Vue.component('question-show', require('./components/QuestionShow.vue'));
Vue.component('question-follow-button', require('./components/QuestionFollowButton.vue'));
Vue.component('label-card', require('./components/LabelCard.vue'));
Vue.component('answer-card', require('./components/AnswerCard.vue'));
Vue.component('comment-card', require('./components/CommentCard.vue'));
Vue.component('login-card', require('./components/LoginCard.vue'));
Vue.component('verification-code-button', require('./components/VerificationCodeButton.vue'));




const app = new Vue({
    el: '#app',
    data: {
        eventHub: new Vue()
    }
});
