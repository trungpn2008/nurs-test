require('./bootstrap');

window.Vue = require('vue').default;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// import axios from 'axios';
import  VueRouter from "vue-router";
// import { createRouter, createWebHistory } from 'vue-router'
import routes from './routers';
import App from './layouts/App.vue'
import VueAxios from 'vue-axios';
import axios from 'axios';
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/css/common.css';
import './assets/css/style.css';
// import Vue from 'vue';
// import VueAwesomeSwiper from 'vue-awesome-swiper'
// import 'swiper/css/swiper.css'
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// import App from './App.vue';

// Vue.use(BootstrapVue)
// Vue.use(IconsPlugin)
// Vue.use(axios)
Vue.use(VueRouter);
Vue.use(VueAxios,axios)
// Vue.use(VueAwesomeSwiper)


// const router =createRouter({
//     history: createWebHistory(),
//     routes: [
//         {
//             path: '/home',
//             component: home,
//             name: 'pc-top1',
//         },
//         {
//             path: '/home2',
//             component: home2,
//             name: 'pc-top2',
//         }
//     ],
// })
const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router: router,
});
