<script setup lang="ts">
import { ref } from 'vue';
import T_short from '../assets/t_short.jpg';
import Hoodie from '../assets/hoodie.jpg';
import Sneekers from '../assets/sneekers.jpeg';
import Trousers from '../assets/trousers.jpg';
import Accessories from '../assets/Accessories.jpg';

const categoryes = ref([
    { id: 1, name: 'Футболки', icon: T_short },
    { id: 2, name: 'Худи', icon: Hoodie },
    { id: 3, name: 'Кроссовки', icon: Sneekers },
    { id: 4, name: 'Штаны', icon: Trousers },
    { id: 5, name: 'Аксесуары', icon: Accessories }
]);
</script>

<template>
    <div class="category">
        <div class="category_main container">
            <a class ="category_main_item" v-for="category in categoryes" :key="category.id">
                <img :src="category.icon" :alt="'category ' + category.id" />
                <span>{{ category.name }}</span>
            </a>
        </div>
    </div>
</template>

<style scoped>
@import '../assets/styles/category.scss';
</style>