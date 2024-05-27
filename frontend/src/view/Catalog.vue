<script setup lang="ts">
import { ref } from 'vue';
import hodi from '../assets/hoodie.jpg';
import Filters from '../components/filters.vue';
import Button from '../components/ui/button.vue';
import FilterMenu from '../components/filterMenu.vue';

let test = hodi;
const filterMenu = ref(false); 

const toggleFilterMenu = () => {
  filterMenu.value = !filterMenu.value;
};

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
              <div class="catalog-main_right_product_card">
                  <a href="#" class="catalog-main_right_product_card_img">
                    <img width="220" height="248" :src= '`${test}`' />
                  </a>
                <div class="catalog-main_right_product_card_text">
                  <a href="#">Худи неКкал</a>
                  <div class="price">
                    <span>5000 $</span>
                    4R
                  </div>
                </div>
              </div>
              <div class="catalog-main_right_product_card">
                  <a href="#" class="catalog-main_right_product_card_img">
                    <img width="220" height="248" :src= '`${test}`' />
                  </a>
                <div class="catalog-main_right_product_card_text">
                  <a href="#">Худи неКкал</a>
                  <div class="price">
                    <span>5000 $</span>
                    4R
                  </div>
                </div>
              </div>
              <div class="catalog-main_right_product_card">
                  <a href="#" class="catalog-main_right_product_card_img">
                    <img width="220" height="248" :src= '`${test}`' />
                  </a>
                <div class="catalog-main_right_product_card_text">
                  <a href="#">Худи неКкал</a>
                  <div class="price">
                    <span>5000 $</span>
                    4R
                  </div>
                </div>
              </div>
              <div class="catalog-main_right_product_card">
                  <a href="#" class="catalog-main_right_product_card_img">
                    <img width="220" height="248" :src= '`${test}`' />
                  </a>
                <div class="catalog-main_right_product_card_text">
                  <a href="#">Худи неКкал</a>
                  <div class="price">
                    <span>5000 $</span>
                    4R
                  </div>
                </div>
              </div>
              <div class="catalog-main_right_product_card">
                  <a href="#" class="catalog-main_right_product_card_img">
                    <img width="220" height="248" :src= '`${test}`' />
                  </a>
                <div class="catalog-main_right_product_card_text">
                  <a href="#">Худи неКкал</a>
                  <div class="price">
                    <span>5000 $</span>
                    4R
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