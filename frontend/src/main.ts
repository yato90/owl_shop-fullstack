import { createApp } from 'vue';
import './assets/styles/main.scss';
import App from './App.vue';
import router from './router/index.ts';
import store from './store/index.ts'; 

createApp(App).use(router).use(store).mount('#app');
