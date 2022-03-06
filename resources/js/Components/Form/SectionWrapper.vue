<script setup>
defineProps({
  warning: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <div class="max-w-7xl mx-auto radius-lg shadow-xl rounded-lg p-4 md:p-6 mb-6 md:mb-9" :class="{'border-red-600 border-2': warning}">
    <slot />
  </div>
</template>
