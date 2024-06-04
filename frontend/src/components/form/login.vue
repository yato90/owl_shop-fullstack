<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { loginUser  } from '../../api/auth';
import Button from '../ui/button.vue';

const email = ref('');
const password = ref('');
const router = useRouter();

const login = async () => {
    try {
        await loginUser({ 
            email: email.value, 
            password: password.value 
        });
        // Перенаправление на страницу профиля
        router.push('/profile');
    } catch (error) {
        console.error('Ошибка входа:', error);
    }
};
</script>

<template>
    <div class="login-form">
        <form @submit.prevent="login">
            <div class="login-form_input">
                <label for="email">Email</label>
                <input type="email" id="email" v-model="email" required>
            </div>
            <div class="login-form_input">
                <label for="password">Password</label>
                <input type="password" id="password" v-model="password" required>
            </div>
            <Button type="submit">Войти</Button>
        </form>
    </div>
</template>
  
<style scoped>
.login-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom:12px;
}
.login-form_input{
    display:flex;
    flex-direction: column;
    text-align:left;
}
form{
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 1rem;
    padding-right: 1rem;
    width: 100%;
}
label{
    color:#6b7280;
}
input{
    border-radius: 0.5rem;
    border-width: 1px;
    margin-bottom: 1rem;
    padding: 0.75rem 1rem;
}
</style>
  