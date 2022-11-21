import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from './pages/HomePage.vue';
import AboutUs from './pages/AboutUs.vue';
import GarageView from './pages/GarageView.vue';
import EmailForm from './pages/EmailForm.vue';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/about-us/',
            name: 'about-us',
            component: AboutUs
        },

        {
            path: '/garage/:slug',
            name: 'garage-view',
            component: GarageView
        },
        {
            path: '/messages/:id',
            name: 'messages',
            component: EmailForm
        },

        
    ]
})

export default router;