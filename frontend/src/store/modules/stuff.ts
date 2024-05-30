import { Module } from 'vuex';
import { getAllStuff, Stuff } from '../../api/stuff.ts';

interface StuffState {
  items: Stuff[];
  loading: boolean;
  best_items: Stuff[];
}

const stuffModule: Module<StuffState, any> = {
  state: {
    items: [],
    loading: false,
    bestItems: [],
  },
  mutations: {
    setItems(state, items: Stuff[]) {
      state.items = items;
    },
    setLoading(state, loading: boolean) {
      state.loading = loading;
    },
    setBestItems(state, bestItems: Stuff[]) {
      state.bestItems = bestItems;
    },
  },
  actions: {
    async fetchAllStuff({ commit }) {
      commit('setLoading', true);
      try {
        const items = await getAllStuff();
        commit('setItems', items);
        const bestItems = items.sort((a: any, b: any) => b.rating - a.rating).slice(0, 4);
        commit('setBestItems', bestItems);
      } catch (error) {
        console.error('Error fetching stuff:', error);
      } finally {
        commit('setLoading', false);
      }
    },
  },
  getters: {
    allStuff(state): Stuff[] {
      return state.items;
    },
    isLoading(state): boolean {
      return state.loading;
    },
    bestStuff(state): Stuff[] {
      return state.bestItems;
    },
  },
};

export default stuffModule;