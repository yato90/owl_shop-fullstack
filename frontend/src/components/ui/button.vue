<script setup lang="ts">

</script>

<template>
    <div class="button">
        <button>
            <slot></slot>
        </button>
    </div>
</template>
  
<style scoped>
button{
    margin-top: 5px;
    margin-bottom: 5px;
    width: 100%;
    padding: 0.5rem;
    border-radius:0.5rem;
    border:none;
    color: #fff;;
    font-weight: 600;
    background-color: #4caf50;
    box-shadow: none;
    cursor: pointer;
}
button:hover {
    background-color: #7dc57f;
}
</style>
  