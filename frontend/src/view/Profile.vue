<script setup lang="ts">
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import { logoutUser  } from '../api/auth';
import { useRouter } from 'vue-router';
import Button from '../components/ui/button.vue';
import { removeFromBasket } from '../api/stuff.ts';

const router = useRouter();
const store = useStore();

const fetchStuff = async () => {
  await store.dispatch('fetchBasketStuff',);
};
onMounted(() => {
  fetchStuff();
});

const loading = computed(() => store.getters.isLoading);
const basket_stuffs = computed(() => store.getters.basketStuff);

const logout = async() => {
    try {
        await logoutUser();
        router.push('/');
    } catch (error) {
        console.error('Ошибка выхода:', error);
    }
};
</script>

<template>
    <div class="container">
        <div class="profile-page">
            <div class="profile-page_left">
                <h1>Мой аккаунт</h1>
                <p>Добро пожаловать</p>
                <p>email: в процессе</p>
                <Button @click="logout">Выйти</Button>
            </div>
            <div class="profile-page_right">
                <div v-if="loading">Loading...</div>
                <section v-else class="profile-page_right_product">
                    <div v-for="stuff in basket_stuffs" :key="stuff.id" class="profile-page_right_product_card">
                        <a href="#" class="profile-page_right_product_card_img">
                        <img :src="`http://localhost:3000/src/assets/${stuff.img}.jpg`" :alt="stuff.name" width="220" height="248" />
                        </a>
                        <div class="profile-page_right_product_card_text"> 
                        <a href="#">{{ stuff.name }}</a>
                        <div class="price">
                            <span>{{ stuff.price }} ₽</span>
                            {{ stuff.rating }}R
                        </div>
                        <Button @click="removeFromBasket(stuff.id)">Убрать из корзины</Button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
  
<style scoped>
@import '../assets/styles/Profile.scss';
</style>
  