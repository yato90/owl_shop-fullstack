<script setup lang="ts">
import { ref, onMounted } from 'vue';
import Price from "./ui/price.vue";
import FilterCheckbox from './ui/filterCheckbox.vue';
import Button from './ui/button.vue';
import blue from '../assets/ui/blue.png';
import red from '../assets/ui/red.png';
import yellow from '../assets/ui/yellow.png';
import green from '../assets/ui/green.png';
import black from '../assets/ui/black.png';

let minPrice = ref(0);
let maxPrice = ref(10000);

const categoryOptions = [
  { value: '1', label: 'Худи' },
  { value: '2', label: 'Футболки' },
  { value: '3', label: 'Кеды' },
  { value: '4', label: 'Штаны' },
  { value: '5', label: 'Аксесуары' },
];
const sizeOptions = [
  { value: 'large', label: 'Большой' },
  { value: 'medium', label: 'Средний' },
  { value: 'small', label: 'Маленький' },
];
const colorOptions = [
  { value: 'blue', label: { image: blue } },
  { value: 'red', label: { image: red } },
  { value: 'yellow', label: { image: yellow } },
  { value: 'green', label: { image: green } },
  { value: 'black', label: { image: black } },
];
const raitingOptions = [
  { value: '5', label: '5' },
  { value: '4', label: '4' },
  { value: '3', label: '3' },
  { value: '2', label: '2' },
  { value: '1', label: '1' },
];

let selectedCategories = ref<string[]>([]);
let selectedSizes = ref<string[]>([]);
let selectedColor = ref<string[]>([]);
let selectedRaiting = ref<string[]>([]);

function updateMinPrice(value: number) {
  minPrice.value = value;
}
function updateMaxPrice(value: number) {
  maxPrice.value = value;
}

function updateSelectedCategories(newSelected: string[]) {
  selectedCategories.value = newSelected;
}
function updateSelectedSizes(newSelected: string[]) {
  selectedSizes.value = newSelected;
}
function updateSelectedColor(newSelected: string[]) {
  selectedColor.value = newSelected;
}
function updateSelectedRaiting(newSelected: string[]) {
  selectedRaiting.value = newSelected;
}
const emit = defineEmits(['apply-filters', 'reset-filters']);

const applyFilters = () => {
  emit('apply-filters', {
    minPrice: minPrice.value,
    maxPrice: maxPrice.value,
    categories: selectedCategories.value,
    sizes: selectedSizes.value,
    colors: selectedColor.value,
    rating: selectedRaiting.value,
  });
};
function resetFilters() {
  selectedCategories.value = [];
  selectedSizes.value = [];
  selectedColor.value = [];
  selectedRaiting.value = [];
  minPrice.value = 0;
  maxPrice.value = 10000;
  emit('reset-filters');
}

const props = defineProps({
  selectedCategory: {
    type: String,
    default: null
  }
});
// Применение выбранной категории при загрузке
onMounted(() => {
  if (props.selectedCategory) {
    selectedCategories.value = [props.selectedCategory];
  }
});
</script>

<template>
  <h3>Цена</h3>
  <Price
    :min="0"
    :max="10000"
    :minValue="minPrice"
    :maxValue="maxPrice"
    @update:minValue="updateMinPrice"
    @update:maxValue="updateMaxPrice"
  />
  <h3>Категории</h3>
  <FilterCheckbox
    :options="categoryOptions"
    :selected="selectedCategories"
    @update:selected="updateSelectedCategories"
  />
  <h3>Размеры</h3>
  <FilterCheckbox
    :options="sizeOptions"
    :selected="selectedSizes"
    @update:selected="updateSelectedSizes"
  />
  <h3>Цвет</h3>
  <FilterCheckbox
    :options="colorOptions"
    :selected="selectedColor"
    @update:selected="updateSelectedColor"
  />
  <h3>Рейтинг</h3>
  <FilterCheckbox
    :options="raitingOptions"
    :selected="selectedRaiting"
    @update:selected="updateSelectedRaiting"
  />
  <Button @click="applyFilters">Поиск</Button>
  <Button @click="resetFilters">Очистить фильтры</Button>
</template>

<style scoped>
</style>
