<script setup>
import { ref } from 'vue'
const collapsed = ref(true)
</script>

<template>
  <div>
    <div class="text-gray-600 pb-2 border-b-2 flex justify-between items-center cursor-pointer" @click="collapsed=!collapsed">
      <slot name="header" />
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :class="{'rotate-90': !collapsed}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </div>
    <div class="overflow-hidden" :class="collapsed ? 'h-0' : 'h-auto'">
      <slot name="content" />
    </div>
  </div>
</template>
