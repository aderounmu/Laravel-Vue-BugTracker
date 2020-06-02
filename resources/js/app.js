/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);

/** all routes includes */

import application from './components/ApplicationComponent.vue';
import projects from './components/Pages/Projects.vue';
import home from './components/Pages/Home.vue';
import bugs from './components/Pages/Bugs.vue';
import login from './components/Pages/Login.vue';
import test from './components/Pages/sampledata/testapi.vue';


const routes = [
    {
        path: '/', 
        name:'home',
        component: home //require('./components/ApplicationComponent.vue')
    },
    {
        path: '/project', 
        name:'Project',
        component: projects //require('./components/ApplicationComponent.vue')
    },
    {
        path: '/project/:id/bug', 
        name:'Bugs',
        component: bugs //require('./components/ApplicationComponent.vue')
    },
    {
        path: '/login',
        name:'login',
        component: login
    },
    {
        path: '/test',
        name:'test',
        component: test
    }
]

const router = new VueRouter({
    routes : routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('application', require('./components/ApplicationComponent.vue').default);
Vue.component('Title-banner', require('./components/Includes/Banner.vue').default);
Vue.component('Navigation', require('./components/Includes/Navbar.vue').default);
Vue.component('Projects', require('./components/Pages/Projects.vue').default);
Vue.component('Login', require('./components/Pages/Login.vue').default);
Vue.component('test', require('./components/Pages/sampledata/testapi.vue').default);
Vue.component('home', require('./components/Pages/Home.vue').default);
Vue.component('PageHeader',require('./components/Includes/PageHeader.vue').default);
//Vue.component('home-component', require('./components/HomeComponent.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
//     router
// });

const app = new Vue({
    router
}).$mount('#app');