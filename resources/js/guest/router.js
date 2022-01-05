import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

// import Welcome from './pages/Welcome';
import Home from './pages/Home.vue'
import MenuRestaurant from './pages/MenuRestaurant.vue'
import Checkout from './pages/Checkout.vue'
import NotFound from './pages/NotFound';
import OrderSuccess from './pages/OrderSuccess.vue';
const router = new VueRouter({
    mode: 'history',
    routes: [
        // {
        //     path: '/',
        //     name: 'welcome',
        //     component: Welcome
        // },
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/restaurants/:slug',
            name: 'menu-restaurant',
            component: MenuRestaurant
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout
        },
        {
            path: '/order',
            name: 'order',
            component: OrderSuccess
        },
        {
            path: '/*',
            name: 'not-found',
            component: NotFound
        },
    ],
});

export default router;