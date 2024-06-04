import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import HomePage from '../view/Home.vue';
import Catalog from '../view/Catalog.vue';
import Category from '../view/Category.vue';
import Auth from '../view/Auth.vue';
import Profile  from '../view/Profile.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Home',
    component: HomePage,
  },
  {
    path: '/catalog',
    name: 'Catalog',
    component: Catalog,
  },
  {
    path: '/category',
    name: 'Category',
    component: Category,
  },
  {
    path: '/auth',
    name: 'Auth',
    component: Auth,
  },
  {
    path: '/profile',
    name: 'Profile',
    component: Profile,
    meta: { requiresAuth: true },
  },
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const token = localStorage.getItem('token');

  if (requiresAuth && !token) {
    next('/auth');
  } else {
    next();
  }
});

export default router;