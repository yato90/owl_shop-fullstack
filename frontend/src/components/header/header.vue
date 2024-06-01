<script setup lang="ts">
import { ref, watch, onMounted, onBeforeUnmount } from 'vue';
import { useStore } from 'vuex';
import burgerMenu from './burgerMenu.vue';
import wishList from './wishList.vue';
import logo from '../../assets/logo.png';
import account from '../../assets/account.png';
import basket from '../../assets/basket.png';

const isSearchVisability = ref(false);
const windowWidth = ref(window.innerWidth);
const menuOpen = ref(false); 
const wishOpen = ref(false);
const store = useStore();
const searchQuery = ref('');

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};
const toggleWish = () => {
    wishOpen.value = !wishOpen.value;
};
const updateWindowWidth = () => {
    windowWidth.value = window.innerWidth;
    if (windowWidth.value > 640) {
        isSearchVisability.value = false;
    }
};
const toggleSearchHidden = () => {
    isSearchVisability.value = !isSearchVisability.value;
};
const updateSearch = () => {
    store.commit('setSearchQuery', searchQuery.value);
};

watch(searchQuery, (newQuery) => {
    store.commit('setSearchQuery', newQuery);
});

onMounted(() => {
    window.addEventListener('resize', updateWindowWidth);
});
onBeforeUnmount(() => {
    window.removeEventListener('resize', updateWindowWidth);
});
</script>

<template>
    <header>
        <div class="header-main container">
            <div class="header-main_burger" @click="toggleMenu">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    aria-hidden="true" role="img" class="icon mr-4 cursor-pointer" 
                    style="" width="26px" height="26px" viewBox="0 0 512 512" data-v-e8d572f6="">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"></path>
                </svg>
            </div>
            <div class="header-main_logo">
                <router-link to="/" ><img :src="logo" alt= "logo" width="48" height="48"/></router-link>
                <span>OwlShop</span>
            </div>
            <nav class="header-main_nav">
                <router-link to="/" ><a>Главная</a></router-link>
                <router-link to="/catalog" ><a>Каталог</a></router-link>
                <router-link to="/category" ><a>Категории</a></router-link>
            </nav>
            <div class="header-main_search">
                <form class="header-main_search_form">
                    <svg class="search_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        aria-hidden="true" role="img" style="" width="24px" height="24px" viewBox="0 0 512 512" 
                        data-v-e8d572f6="">
                        <path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M221.09 64a157.09 157.09 0 1 0 157.09 157.09A157.1 157.1 0 0 0 221.09 64Z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
                    </svg>
                    <input v-model="searchQuery" @input="updateSearch" placeholder="Поиск товара">
                </form>
                <div class="header-main_search_hidden" @click="toggleSearchHidden">
                    <svg class="search_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        aria-hidden="true" role="img" style="" width="24px" height="24px" viewBox="0 0 512 512" 
                        data-v-e8d572f6="">
                        <path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M221.09 64a157.09 157.09 0 1 0 157.09 157.09A157.1 157.1 0 0 0 221.09 64Z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
                    </svg>
                </div>
                <div class="header-main_search_users">
                    <a class = "header-main_search_users_hidden" href="#">
                        <img :src="account" alt= "logo" width="24" height="24"/>
                    </a>
                    <a href="#" @click="toggleWish">
                        <img :src="basket" alt= "logo" width="24" height="24"/>
                    </a>
                </div>
            </div>
        </div>
        <burgerMenu :isOpen="menuOpen"  @close="toggleMenu"/>
        <wishList :isOpen="wishOpen"  @close="toggleWish"/>
        <div class="header-hidden container" v-if="isSearchVisability">
            <form class="header-hidden_search">
                <svg class="search_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    aria-hidden="true" role="img" style="" width="24px" height="24px" viewBox="0 0 512 512" 
                    data-v-e8d572f6="">
                    <path fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" d="M221.09 64a157.09 157.09 0 1 0 157.09 157.09A157.1 157.1 0 0 0 221.09 64Z"></path><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"></path>
                </svg>
                <input type="text" placeholder="Поиск товара">
            </form>
        </div>
    </header>
</template>

<style scoped>
@import '../../assets/styles/header.scss';
</style>