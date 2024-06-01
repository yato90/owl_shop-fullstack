import { Module } from 'vuex';
import { getAllStuff, Stuff, StuffFilters, getFilteredStuff } from '../../api/stuff.ts';

interface StuffState {
  items: Stuff[];
  loading: boolean;
  best_items: Stuff[];
  searchQuery: string;
  filteredItems: StuffFilters[];
  filters: any;
}

const stuffModule: Module<StuffState, any> = {
  state: {
    items: [],
    loading: false,
    bestItems: [],
    searchQuery: '',
    filteredItems: [],
    filters: {},
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
    setSearchQuery(state, query: string) {
      state.searchQuery = query;
    },
    setFilteredItems(state, filteredItems: StuffFilters[]) { 
      state.filteredItems = filteredItems;
    },
    setFilters(state, filters: any) {
      state.filters = filters;
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
    async fetchFilteredStuff({ commit, state }) {
      commit('setLoading', true);
      try {
        const filteredItems = await getFilteredStuff(state.filters);
        commit('setFilteredItems', filteredItems);
      } catch (error) {
        console.error('Error fetching filtered stuff:', error);
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
    searchStuff(state): Stuff[] {
      if(state.searchQuery){
        const query = state.searchQuery.toLowerCase();
        return state.items.filter(item => item.name.toLowerCase().includes(query));
      }
      return state.searchQuery;
    },
    filteredStuff(state): StuffFilters[] {
      if (state.searchQuery) {
        return state.filteredItems.filter(item => 
          item.name.toLowerCase().includes(state.searchQuery.toLowerCase())
        );
      }
      return state.filteredItems;
    },
  },
};

export default stuffModule;