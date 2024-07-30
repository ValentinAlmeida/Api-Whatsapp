import { RouteRecordRaw, createRouter, createWebHistory } from 'vue-router';

const routes: RouteRecordRaw[] = [
    {
        name: 'login',
        path: '/',
        component: () => import('../views/acesso/LoginView.vue'),
    },
    {
        name: 'inicio',
        path: '/inicio',
        component: () => import('../views/Inicial.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
