<script setup lang="ts">

const props = defineProps({
  isOpen: Boolean
});
const emit = defineEmits(['close']);

const closeMenu = () => {
  emit('close');
};
</script>

<template>
    <transition name="slide">
        <div class="burger-menu" v-if="props.isOpen">
            <button class="close-button" @click="closeMenu">X</button>
            <nav>
                <ul>
                <router-link to="/" ><li><a>Главная</a></li></router-link>
                <router-link to="/catalog" ><li><a>Каталог</a></li></router-link>
                <router-link to="/category" ><li><a>Категории</a></li></router-link>
                <li><a href="#">Аккаунт</a></li>
                </ul>
            </nav>
        </div>
    </transition>
</template>

<style scoped>
.burger-menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    padding: 0.5rem;
    background-color: #fff;
    border-right: 1px solid #d1d5db;
    border-radius:0.3rem;
    z-index: 1000;
}
.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
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
.burger-menu nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
.burger-menu nav ul li:hover {
    background: #d1d5db;
}
.burger-menu nav ul li {
    padding: 16px;
}
.burger-menu nav ul li a {
    color: #333;
}

.slide-enter-from{
    transform: translateX(-100%);
}

.slide-enter-active, .slide-leave-active {
    transition: transform 0.3s ease;
}

.slide-leave-active {
  transform: translateX(-100%);
}
</style>
  