import Vue from 'vue';
import router from './router';
import App from './views/App';

const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
});