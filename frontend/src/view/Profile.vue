<script setup lang="ts">
import { logoutUser  } from '../api/auth';
import { useRouter } from 'vue-router';

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
    <div class="profile-page">
        <h1>Профиль</h1>
        <p>Добро пожаловать,</p>
        <button @click="logout">Logout</button>
    </div>
</template>
  
<style scoped>
.profile-page {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}
</style>
  