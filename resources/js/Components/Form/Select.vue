<script setup>
defineProps({
  selected: Number,
  options: Array,
})

defineEmits(['update:modelValue'])
</script>

<template>
  <select
    ref="input" modelValue="selected"
    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @input="$emit('update:modelValue', $event.target.value)"
  >
    <option v-for="(option, id) in options" :key="id" :value="option.value" :selected="option.selected">{{ option.title }}</option>
  </select>
</template>
