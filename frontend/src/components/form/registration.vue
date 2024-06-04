<script setup lang="ts">
import { ref } from 'vue';
import Button from '../ui/button.vue';
import { useRouter } from 'vue-router';
import { registerUser  } from '../../api/auth';

const email = ref('');
const password = ref('');
const passwordConfirmation = ref('');
const router = useRouter();

const Register = async () => {
  try {
    await registerUser({
        email: email.value,
        password: password.value,
    });
    // Перенаправление на страницу профиля
    router.push('/profile');
  } catch (error) {
    console.error('Ошибка регистрации', error);
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
            </div>
            <div class="registration-form_input">
                <label for="confirmPassword">Повторить пароль</label>
                <input type="password" id="confirmPassword" v-model="passwordConfirmation" required>
            </div>
            <Button type="submit">Зарегистрироваться</Button>
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
  