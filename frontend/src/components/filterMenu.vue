<script setup lang="ts">
import Filters from './filters.vue';

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
        <div class="filter-menu" v-if="props.isOpen">
            <button class="close-button" @click="closeMenu">X</button>
            <Filters/>
        </div>
    </transition>
</template>

<style scoped>
.filter-menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    padding: 0.5rem;
    background-color: #fff;
    border-right: 1px solid #d1d5db;
    border-radius:0.3rem;
    overflow: auto;
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
  