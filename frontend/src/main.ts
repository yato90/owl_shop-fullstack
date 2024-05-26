import { createApp } from 'vue';
import './assets/styles/main.scss';
import router from './router/index.ts';
import App from './App.vue';

createApp(App).use(router).mount('#app');
