import DashboardLayout from '@/views/Layout/DashboardLayout.vue';
import AuthLayout from '@/views/Pages/AuthLayout.vue';

import NotFound from '@/views/NotFoundPage.vue';

const routes = [
    {
        path: '/',
        redirect: 'food-entries',
        component: DashboardLayout,
        children: [
            {
                path: '/food-entries',
                name: 'food-entries',
                meta: {
                    auth: true
                },
                component: () => import(/* webpackChunkName: "demo" */ '../views/Food/FoodEntries.vue')
            },
            {
                path: '/food-entries-create',
                name: 'add-food-entries',
                meta: {
                    auth: true
                },
                component: () => import(/* webpackChunkName: "demo" */ '../views/Food/Create.vue')
            },
            {
                path: '/calorie-history',
                name: 'Calorie report for month',
                meta: {
                    auth: true
                },
                component: () => import(/* webpackChunkName: "demo" */ '../views/Food/CalorieHistory.vue')
            },

        ]
    },
    {
        path: '/',
        redirect: 'login',
        component: AuthLayout,
        children: [
            {
                path: '/login',
                name: 'login',
                component: () => import(/* webpackChunkName: "demo" */ '../views/Pages/Login.vue'),
                meta: {
                    guest: true
                }
            },
            {
                path: '/register',
                name: 'register',
                component: () => import(/* webpackChunkName: "demo" */ '../views/Pages/Register.vue'),
                meta: {
                    guest: true
                }
            },
            {path: '*', component: NotFound}
        ]
    }
];

export default routes;
