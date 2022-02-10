// importazione Vue Router 

import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './pages/Home.vue';
import About from './pages/About.vue';
import PostDetail from './pages/PostDetail.vue';

//Utilizzo Vue Router

Vue.use(VueRouter);


// Definizione delle removeAttribute

const router = new VueRouter({
    moode: 'history',
    linkExactActiveClass: 'active',
    routes : [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        
        {
            path: '/about',
            name: 'about',
            component: About,
        },

        {
            path: '/posts/:slug',
            name: 'post-detail',
            component: PostDetail,
        },
    ]
});

export default router;
