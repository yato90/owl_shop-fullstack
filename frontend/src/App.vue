<script setup lang="ts">
import { onMounted } from 'vue';
import hedaer from './components/header/header.vue';
import Footer from './components/footer/footer.vue';
import { useStore } from 'vuex';

const store = useStore();
const fetchStuff = async () => {
  await store.dispatch('fetchAllStuff',);
};
onMounted(() => {
  fetchStuff();
});
</script>

<template>
  <hedaer />
  <router-view/>
  <Footer />
</template>

<style scoped>
</style>
