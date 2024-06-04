<script setup lang="ts">
import { ref  } from 'vue';
import { useRouter } from 'vue-router';
import T_short from '../assets/t_short.jpg';
import Hoodie from '../assets/hoodie.jpg';
import Sneekers from '../assets/sneekers.jpg';
import Trousers from '../assets/trousers.jpg';
import Accessories from '../assets/accessories.jpg';

const categoryes = ref([
    { id: 1, name: 'Худи', icon:Hoodie },
    { id: 2, name: 'Футболки', icon: T_short },
    { id: 3, name: 'Кроссовки', icon: Sneekers },
    { id: 4, name: 'Штаны', icon: Trousers },
    { id: 5, name: 'Аксесуары', icon: Accessories }
]);

const router = useRouter();
const selectCategory = (categoryId: number) => {
    router.push({ path: '/catalog', query: { category: categoryId } });
};
</script>

<template>
    <div class="category">
        <div class="category_main container">
            <a class ="category_main_item" v-for="category in categoryes" :key="category.id" @click="selectCategory(category.id)">
                <img :src="category.icon" :alt="'category ' + category.id" />
                <span>{{ category.name }}</span>
            </a>
        </div>
    </div>
</template>

<style scoped>
@import '../assets/styles/category.scss';
</style>