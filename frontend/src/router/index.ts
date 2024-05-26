import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import HomePage from '../view/Home.vue';
import Catalog from '../view/Catalog.vue';
import Category from '../view/Category.vue';

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
  // Добавьте больше маршрутов по мере необходимости
];
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;