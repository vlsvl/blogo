<template>
  <div class="w-full hover:text-main-blue">
    <button class="text-sm uppercase font-bold flex justify-between items-center py-3 w-full" :class="{'text-main-blue': !collapsed}" @click="toggle">
      <span class="block">
        <icon :name="icon" />
        {{ title }}
      </span>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :class="{'rotate-90': !collapse}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>
    <div class="overflow-hidden" :class="collapse ? 'h-0' : 'h-auto'">
      <slot />
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import Icon from '@/Components/Icon'

export default defineComponent ({
  components: {
    Icon,
  },
  props: {
    title: String,
    collapsed: Boolean,
    icon: String,
  },
  data() {
    return {
      collapse: true,
    }
  },
  mounted () {
    this.collapse = this.collapsed
  },
  methods: {
    toggle() {
      this.collapse = ! this.collapse
    },
  },
})
</script>
