import { createRouter, createWebHashHistory } from 'vue-router';
import UserIndexView from '../views/user/UserIndexView.vue';
import UserProfileView from '../views/user/UserProfileView.vue';


const routes = [
    {
        path: '/',
        name: 'home',
        redirect: {
            name: 'users.index',
        }
    },
    {
        path: '/users',
        name: 'users.index',
        component: UserIndexView,
    },
    {
        path: '/users/:id',
        name: 'users.profile',
        component: UserProfileView,
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router
