// importazione Vue Router 

import Vue from 'vue';
import VueRouter from 'vue-router';

//Utilizzo Vue Router

Vue.use(VueRouter);


// Definizione delle removeAttribute

const router = new Vue({
    moode: 'history',
    router : [
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
    ]
});

export default router;
