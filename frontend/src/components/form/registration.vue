<script setup lang="ts">
import { ref } from 'vue';
import Button from '../ui/button.vue';
import { useRouter } from 'vue-router';
import { registerUser  } from '../../api/auth';

let email = ref('');
let password = ref('');
let passwordConfirmation = ref('');
let router = useRouter();
let isLoading = ref(false);
let errorForm = ref(false);

const Register = async () => {
    if (password.value !== passwordConfirmation.value) {
        errorForm.value = true;
        return;
    }
    if (password.value.length < 6) {
        errorForm.value = true;
        return;
    }
    isLoading.value = true;
    try {
        await registerUser({
            email: email.value,
            password: password.value,
        });
        // Перенаправление на страницу профиля
        router.push('/profile');
    } catch (error) {
        console.error('Ошибка регистрации', error);
    } finally {
        isLoading.value = false;
    }
};
</script>

<template>
    <div class="registration-form">
        <form @submit.prevent="Register">
            <div class="registration-form_input">
                <label for="email">Email</label>
                <input type="email" id="email" v-model="email" required>
            </div>
            <div class="registration-form_input">
                <label for="password">Пароль</label>
                <input type="password" id="password" v-model="password" required>
                <span>Должен содержать минимум 6 символов</span>
            </div>
            <div class="registration-form_input">
                <label for="confirmPassword">Повторить пароль</label>
                <input type="password" id="confirmPassword" v-model="passwordConfirmation" required>
            </div>
            <Button type="submit">Зарегистрироваться</Button>
            <div v-if="isLoading" class="loader">Loading...</div>
            <div v-if="errorForm" class="error">Неправильные данные</div>
        </form>
    </div>
</template>

<style scoped>
.registration-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom:12px;
}
.registration-form_input{
    display:flex;
    flex-direction: column;
    text-align:left;
    margin-bottom: 1rem;
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
    padding: 0.75rem 1rem;
}
span{
    color:#6b7280;
}
.loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
}
.error{
    color:red;
}
</style>
  