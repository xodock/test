/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// NProgress = require('nprogress');
window.Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.http.options.root = '/api';
// Vue.http.interceptors.push((request, next) => {
//     NProgress.start();
//     next((response)=>{
//         NProgress.done();
//     });
// });
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('comments', require('./components/comments/Comments.vue'));
Vue.component('comment', require('./components/comments/Comment.vue'));
Vue.component('answers', require('./components/comments/Answers.vue'));
Vue.component('commentForm', require('./components/comments/CommentForm.vue'));

const app = new Vue({
    el: '#app'
});
