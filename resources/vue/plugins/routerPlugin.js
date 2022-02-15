import router from '@/routes/router';
import store from "@/store";

router.beforeEach((to, from, next) => {
    if (to.meta.guest && store.getters['auth/token']) {
        return next({ name: 'food-entries' });
    }
    next()
})

router.beforeEach((to, from, next) => {
    if (to.meta.auth && !store.getters['auth/token']) {
        return next({ name: 'login' });
    }
    next()
})

export default router;
