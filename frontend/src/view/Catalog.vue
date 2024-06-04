<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import Filters from '../components/filters.vue';
import Button from '../components/ui/button.vue';
import FilterMenu from '../components/filterMenu.vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const filterMenu = ref(false);

const toggleFilterMenu = () => {
  filterMenu.value = !filterMenu.value;
}
const store = useStore();
const route = useRoute();

const stuffs = computed(() => store.getters.allStuff);
const loading = computed(() => store.getters.isLoading);
const searchStuff = computed(() => store.getters.searchStuff);
const filteredStuff = computed(() => store.getters.filteredStuff);

const applyFilters = (filters: any) => {
  store.commit('setFilters', filters);
  store.dispatch('fetchFilteredStuff');
};

const resetFilters = () => {
  store.commit('setFilters', {});
  store.dispatch('fetchFilteredStuff');
};

// Получение категории из URL
const selectedCategory:any = ref(route.query.category);

onMounted(() => {
  if (selectedCategory.value) {
    applyFilters({ categories: [selectedCategory.value] });
  }
});
</script>

<template>
  <div class="catalog ">
    <FilterMenu :isOpen="filterMenu"  @close="toggleFilterMenu" />
      <div class="catalog-main container">
          <div class="catalog-main_left">
            <Filters :selectedCategory="selectedCategory" @apply-filters="applyFilters" @reset-filters="resetFilters" />
          </div>
          <div class="catalog-main_right">
            <Button class="catalog-main_right_button" @click="toggleFilterMenu">Фильтры</Button>
            <div v-if="loading">Loading...</div>
            <section v-else class="catalog-main_right_product">
              <div v-if="searchStuff.length > 0" v-for="stuffSearch in searchStuff" :key="stuffSearch.id" class="catalog-main_right_product_card 1">
                  <a href="#" class="catalog-main_right_product_card_img">
                    <img :src="`http://localhost:3000/src/assets/${stuffSearch.img}.jpg`" :alt="stuffSearch.name" width="220" height="248" />
                  </a>
                  <div class="catalog-main_right_product_card_text"> 
                    <a href="#">{{ stuffSearch.name }}</a>
                    <div class="price">
                      <span>{{ stuffSearch.price }} ₽</span>
                      {{ stuffSearch.rating }}R
                    </div>
                  </div>
              </div>
              <div v-else-if="filteredStuff.length > 0" v-for="filterStuff in filteredStuff" :key="filterStuff.id" class="catalog-main_right_product_card 2">
                <a href="#" class="catalog-main_right_product_card_img">
                  <img :src="`http://localhost:3000/src/assets/${filterStuff.img}.jpg`" :alt="filterStuff.name" width="220" height="248" />
                </a>
                <div class="catalog-main_right_product_card_text"> 
                  <a href="#">{{ filterStuff.name }}</a>
                  <div class="price">
                    <span>{{ filterStuff.price }} ₽</span>
                    {{ filterStuff.rating }}R
                  </div>
                </div>
              </div>
              <div v-else v-for="stuff in stuffs" :key="stuff.id" class="catalog-main_right_product_card test">
                <a href="#" class="catalog-main_right_product_card_img">
                  <img :src="`http://localhost:3000/src/assets/${stuff.img}.jpg`" :alt="stuff.name" width="220" height="248" />
                </a>
                <div class="catalog-main_right_product_card_text"> 
                  <a href="#">{{ stuff.name }}</a>
                  <div class="price">
                    <span>{{ stuff.price }} ₽</span>
                    {{ stuff.rating }}R
                  </div>
                </div>
              </div>
            </section>
          </div>
      </div>
  </div>
</template>

<style scoped>
@import '../assets/styles/catalog.scss';
</style>