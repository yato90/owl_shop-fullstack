<script setup lang="ts">
import { ref, computed } from 'vue';
import company1 from '../assets/company1.png';
import company2 from '../assets/company2.png';
import box from '../assets/box.png';
import cashback from '../assets/cashback.png';
import secure from '../assets/secure.png';
import support from '../assets/support.png';
import { useStore } from 'vuex';

const companies = ref([
    { id: 1, icon: company1 },
    { id: 2, icon: company2 },
    { id: 3, icon: company1 },
    { id: 4, icon: company2 },
    { id: 5, icon: company1 }
]);
const advantages = ref([
      { id: 1, text_xl: 'Бесплатная доставка', text_sm: 'Бесплатная доставка при заказе на сумму свыше 1000 руб', icon: box},
      { id: 2, text_xl: 'Гарантия', text_sm: 'Гарантия возврата денег на 30 дней', icon: cashback},
      { id: 3, text_xl: 'Безопасная оплата', text_sm: 'С нами ваши платежи будут в безопасности', icon: secure},
      { id: 4, text_xl: 'Поддержка', text_sm: 'Круглосуточная онлайн-поддержка', icon: support}
]);

const store = useStore();
const bestStuff = computed(() => store.getters.bestStuff);
</script>

<template>
    <div class="home-promo">
        <div class ="home-promo_text">
            <h1>Добро пожаловать</h1>
        </div>
    </div>
    <div class="home-company">
        <div class="home-company_item" v-for="company in companies" :key="company.id">
            <img :src="company.icon" :alt="'Company ' + company.id" />
        </div>
    </div>
    <div class="home-product">
        <h2>Лучшие товары</h2>
        <div class="home-product_item">
            <div v-for="stuff in bestStuff" :key="stuff.id" class="home-product_item_card">
                <a href="#" class="home-product_item_card_img">
                  <img :src="`http://localhost:3000/src/assets/${stuff.img}.jpg`" :alt="stuff.name" width="300" height="248" />
                </a>
                <div class="home-product_item_card_text"> 
                  <a href="#">{{ stuff.name }}</a>
                  <div class="price">
                    <span>{{ stuff.price }} ₽</span>
                    {{ stuff.rating }}R
                  </div>
                </div>
              </div>
        </div>
    </div> 
    <div class="home-advantages">
        <div class="home-advantages_item" v-for="advantage  in advantages " :key="advantage.id">
            <img :src="advantage.icon" :alt="'advantage ' + advantage.id" />
            <div>
                <h3>{{ advantage.text_xl }}</h3>
                {{ advantage.text_sm }}
            </div>
        </div>
    </div>
</template>

<style scoped>
@import '../assets/styles/Home.scss';
</style>