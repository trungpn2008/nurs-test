require('./bootstrap');

window.Vue = require('vue').default;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import axios from 'axios';
import Front from './layouts/frontend.vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// import App from './App.vue';

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(axios)

const app = new Vue({
    el: '#app',
    render: h => h(Front)
});
n
