<script setup lang="ts">
import logo from '../../assets/logo.png';
</script>

<template>
    <footer class="container">
        <div class="footer-main">
            <div class="footer-main_logo">
                <img :src="logo" alt= "logo" width="48" height="48"/>
                <span>OwlShop</span>
            </div>
            <div class="footer-main_select">
                <select>
                    <option value="eng">English</option>
                    <option value="rus">Русский</option>
                </select>
            </div>
        </div>
        <div class="footer-other">OwlShop - by yato90</div>
    </footer>
</template>

<style scoped>
@import '../../assets/styles/footer.scss';
</style>