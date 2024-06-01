<script setup lang="ts">
import { shallowRef } from 'vue';
import Login from '../components/form/login.vue';
import Registration from '../components/form/registration.vue';

const currentComponent = shallowRef(Login);

const togglePage = () => {
  currentComponent.value = currentComponent.value === Login ? Registration : Login;
};
</script>

<template>
    <div class="auth-page">
        <div class="auth-page_form container">
            <h1>Аккаунт</h1>
            <component :is="currentComponent"></component>
            <span @click="togglePage">
                {{ currentComponent === Login ? 'Зарегистрироваться' : 'Уже есть аккаунт' }}
            </span>
        </div>
    </div>
</template>

<style scoped>
@import '../assets/styles/Auth.scss';
</style>