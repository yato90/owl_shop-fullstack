<script setup lang="ts">
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import Button from '../ui/button.vue';
import { removeFromBasket } from '../../api/stuff.ts';

const props = defineProps({
  isOpen: Boolean
});
const emit = defineEmits(['close']);
const closeMenu = () => {
  emit('close');
};

const store = useStore();

const fetchStuff = async () => {
  await store.dispatch('fetchBasketStuff',);
};
onMounted(() => {
  fetchStuff();
});

const loading = computed(() => store.getters.isLoading);
const basket_stuffs = computed(() => store.getters.basketStuff);
</script>

<template>
    <transition name="slide">
        <div class="burger-menu" v-if="props.isOpen">
            <button class="close-button" @click="closeMenu">X</button>
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
    </transition>
</template>

<style scoped>
@import '../../assets/styles/Profile.scss';
.burger-menu {
    position: fixed;
    top: 0;
    right: 0;
    width: 250px;
    height: 100%;
    padding: 0.5rem;
    background-color: #fff;
    border-right: 1px solid #d1d5db;
    border-radius:0.3rem;
    z-index: 1000;
    overflow: scroll;
}
.profile-page_right{
    padding: 0.5rem;
}
.profile-page_right_product{
    grid-template-columns: repeat(1, minmax(0, 1fr));
}
.close-button {
    position: absolute;
    top: 10px;
    left: 10px;
    background: none;
    border: 1px solid #d1d5db;
    border-radius:0.3rem;
    color: #333;
    font-size: 24px;
    cursor: pointer;
}
.close-button:hover {
    background: #d1d5db;
}

.slide-enter-from{
    transform: translateX(100%);
}

.slide-enter-active, .slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-leave-active {
  transform: translateX(100%);
}
</style>