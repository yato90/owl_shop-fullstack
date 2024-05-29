<script setup lang="ts">
import { ref, onMounted } from 'vue';
import Filters from '../components/filters.vue';
import Button from '../components/ui/button.vue';
import FilterMenu from '../components/filterMenu.vue';
import { getAllStuff, Stuff } from '../api/stuff.ts';

const filterMenu = ref(false); 
const stuffs = ref<Stuff[]>([]);

const fetchStuff = async () => {
  try {
    const data = await getAllStuff();
    stuffs.value = data;
  } catch (error) {
    console.error('Error fetching stuff:', error);
  }
};
const toggleFilterMenu = () => {
  filterMenu.value = !filterMenu.value;
}

onMounted(() => {
  fetchStuff();
});
</script>

<template>
  <div class="catalog ">
    <FilterMenu :isOpen="filterMenu"  @close="toggleFilterMenu" />
      <div class="catalog-main container">
          <div class="catalog-main_left">
            <Filters/>
          </div>
          <div class="catalog-main_right">
            <Button class="catalog-main_right_button" @click="toggleFilterMenu">Фильтры</Button>
            <section class="catalog-main_right_product">
              <div v-for="stuff in stuffs" :key="stuff.id" class="catalog-main_right_product_card">
                <a href="#" class="catalog-main_right_product_card_img">
                  <img :src="`http://localhost:3000/src/assets/${stuff.img}.jpg`" :alt="stuff.name" width="220" height="248" />
                </a>
                <div class="catalog-main_right_product_card_text"> 
                  <a href="#">{{ stuff.name }}</a>
                  <div class="price">
                    <span>{{ stuff.price }} $</span>
                    {{ stuff.rating }}
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