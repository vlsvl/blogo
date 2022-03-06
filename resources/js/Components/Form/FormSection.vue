<script setup>
import { computed, useSlots } from 'vue'
import SectionTitle from './SectionTitle.vue'

defineEmits(['submitted'])

const hasActions = computed({
  get () {
    return !!useSlots().actions
  },
})
</script>

<template>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <section-title>
      <template #title><slot name="title" /></template>
      <template #description><slot name="description" /></template>
    </section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
      <form @submit.prevent="$emit('submitted')">
        <div
          class="p-o md:px-4 md:py-5 md:border-gray-100 md:border-t-2 md:border-l-2 md:border-r-2"
          :class="hasActions ? 'rounded-tl-md rounded-tr-md' : 'rounded-md border-b-2'"
        >
          <div class="grid gap-6">
            <slot name="form" />
          </div>
        </div>

        <div v-if="hasActions" class="flex items-center justify-end px-0 md:px-4 py-3 text-right md:border-gray-100 md:border-l-2 md:border-r-2 md:border-b-2 rounded-bl-md rounded-br-md">
          <slot name="actions" />
        </div>
      </form>
    </div>
  </div>
</template>
