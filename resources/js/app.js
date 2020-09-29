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
        component: projects, //require('./components/ApplicationComponent.vue')
        meta:{
            requireAuth: true,
        }
    },
    {
        path: '/project/:id/bug', 
        name:'Bugs',
        component: bugs, //require('./components/ApplicationComponent.vue')
        meta:{
            requireAuth: true,
        }
    },
    {
        path: '/login',
        name:'login',
        component: login,
        meta:{
            requireGuest: true
        }
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

//Router Authentication Guards 

router.beforeEach((to,from,next)=>{

    //console.log(sessionStorage.getItem('laravel-vue-bugtracker-loggedin'))            
    let userAuth = sessionStorage.getItem('laravel-vue-bugtracker-loggedin')
    //check if it has the AuthGuard
    if(to.matched.some(record => record.meta.requireAuth)){
        //check if user is Authenicated:
        console.log(`LA-${userAuth}`)
        if(userAuth === 'false' || userAuth === null || userAuth === undefined){
            //go to login page
            next({
                path:'/login',
                query:{
                    type:'Login',
                    redirect: to.fullPath,
                }
            })
        }else{
            //proceed to route 
            next()
        }

    }else if(to.matched.some(record => record.meta.requireGuest)){
        //check if use is Authenicated
        
        if(userAuth === 'true'){
            next({
                path:'/project'
            })
        }else{
            next()
        }
    }else{
        next()
    }
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