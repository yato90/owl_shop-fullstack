<script setup lang="ts">
import { ref, watch, defineProps, defineEmits } from 'vue';

interface Option{
    value: string;
    label: string | { image: string };
}
const props = defineProps<{
    options: Option[];
    selected: string[];
}>();

const emit = defineEmits<{
    (e: 'update:selected', value: string[]): void;
}>();

const selectedOptions = ref([...props.selected]);

watch(() => props.selected, (newSelected) => {
    selectedOptions.value = [...newSelected];
});

function emitSelectedOptions() {
    emit('update:selected', selectedOptions.value);
}
</script>

<template>
    <div class="filter-checkbox">
        <div v-for="option in options" :key="option.value" class="checkbox-container">
            <input
                type="checkbox"
                :id="option.value"
                :value="option.value"
                v-model="selectedOptions"
                @change="emitSelectedOptions"
            />
            <label :for="option.value">
                <template v-if="typeof option.label === 'string'">
                    {{ option.label }}
                </template>
                <template v-else>
                    <img :src="option.label.image" />
                </template>
            </label>
        </div>
    </div>
</template>
  
<style scoped>
.checkbox-container {
    margin: 5px 0;
    display: flex;
    align-items:center;
    gap: 0.5rem;
}
.checkbox-container input{
    padding: 0;
    width: 1rem;
    height: 1rem;
    border-radius: 4px;
    cursor: pointer;
}
.checkbox-container input:checked {
    -webkit-appearance: none;
    appearance: none;
    background-color:#4caf50;
}
label{
    cursor: pointer;
    color: #4b5563;
}
label img {
  width: 20px;
  height: 20px;
}
</style>
  