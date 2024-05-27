<script setup lang="ts">
import { ref, computed, watch } from 'vue';

const props = defineProps<{
  min: number;
  max: number;
  minValue: number;
  maxValue: number;
}>();

const emit = defineEmits(['update:minValue', 'update:maxValue']);

const internalMinValue = ref(props.minValue);
const internalMaxValue = ref(props.maxValue);

function updateMinValue() {
  let newValue = internalMinValue.value;
  if (newValue < props.min) {
    newValue = props.min;
  } else if (newValue > props.max) {
    newValue = props.max;
  } else if (newValue > internalMaxValue.value) {
    newValue = internalMaxValue.value;
  }
  internalMinValue.value = newValue;
  emit('update:minValue', newValue);
}
function updateMaxValue() {
  let newValue = internalMaxValue.value;
  if (newValue < props.min) {
    newValue = props.min;
  } else if (newValue > props.max) {
    newValue = props.max;
  } else if (newValue < internalMinValue.value) {
    newValue = internalMinValue.value;
  }
  internalMaxValue.value = newValue;
  emit('update:maxValue', newValue);
}

// Обновление внутренних значений при изменении props
watch(() => props.minValue, (newValue) => {
  if (newValue !== internalMinValue.value) {
    internalMinValue.value = newValue;
  }
});
watch(() => props.maxValue, (newValue) => {
  if (newValue !== internalMaxValue.value) {
    internalMaxValue.value = newValue;
  }
});

const rangeProgressStyle = computed(() => {
  let left = (internalMinValue.value / props.max) * 100;
  let right = 100 - (internalMaxValue.value / props.max) * 100;
  return {
    left: `${left}%`,
    right: `${right}%`
  };
});
</script>

<template>
    <div class="price-input">
        <div class="price-input_text">
            <input type="number" v-model="internalMinValue" class="min-input" @input="updateMinValue" />
        </div>
        <div class="price-input_text">
            <input type="number" v-model="internalMaxValue" class="max-input" @input="updateMaxValue" />
        </div>
        <div class="price-slider">
            <div class="price-slider_range">
                <div class="price-slider_range_progress" :style="rangeProgressStyle"></div>
            </div>
            <div class="price-slider_input">
                <input
                type="range"
                :min="props.min"
                :max="props.max"
                v-model.number="internalMinValue"
                @input="updateMinValue"
                class="min-range"
                />
                <input
                type="range"
                :min="props.min"
                :max="props.max"
                v-model.number="internalMaxValue"
                @input="updateMaxValue"
                class="max-range"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.price-input {
  margin-bottom: 10px;
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 1rem;
}
.price-input_text {
  display: flex;
}
.price-input_text input{
  --tw-border-opacity: 1;
  border-color: rgb(229 231 235 / var(--tw-border-opacity));
  border-width: 1px;
  border-radius:0.5rem;
  background:#ffffff;
  padding: 0.5rem;
  width: 100%;
}

.price-slider {
  position: relative;
  height: 30px;
  width: 200px;
}

.price-slider_range {
  position: absolute;
  width: 100%;
  height: 5px;
  background-color: #ddd;
}

.price-slider_range_progress {
  position: absolute;
  height: 100%;
  background-color: #4caf50;
}

.price-slider_input {
  position: relative;
  display: flex;
  justify-content: space-between;
  height: 30px;
}
.price-slider_input input[type="range"] {
  -webkit-appearance: none;
  appearance: none;
  width: 100%;
  height: 5px;
  background: transparent;
  position: absolute;
  pointer-events: none;
}

.price-slider_input input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  pointer-events: all;
  width: 20px;
  height: 20px;
  background-color: #4caf50;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  z-index: 1;
}
</style>
  