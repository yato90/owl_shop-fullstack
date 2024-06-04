<script setup lang="ts">
import { logoutUser  } from '../api/auth';
import { useRouter } from 'vue-router';
import Button from '../components/ui/button.vue';

const router = useRouter();

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
            <div class="profile-page_right"></div>
        </div>
    </div>
</template>
  
<style scoped>
@import '../assets/styles/Profile.scss';
</style>
  