import { createStore } from 'vuex';
import stuffModule from './modules/stuff';

export default createStore({
  modules: {
    stuff: stuffModule,
  },
});