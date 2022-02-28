<script setup>
import { computed, useSlots } from 'vue'
import SectionTitle from './SectionTitle.vue'

defineEmits(['submitted'])

defineProps({
  warning: {
    type: Boolean,
    default: false,
  },
})

const hasActions = computed({
  get () {
    return !!useSlots().actions
  },
})
</script>

<template>
  <div class="max-w-7xl mx-auto radius-lg shadow-xl rounded-lg p-4 md:p-6 mb-6 md:mb-9" :class="{'border-red-600 border-2': warning}">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <section-title>
        <template #title><slot name="title" /></template>
        <template #description><slot name="description" /></template>
      </section-title>

      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="$emit('submitted')">
          <div
            class="px-4 py-5 sm:p-6 border-gray-300 border-t-2 border-l-2 border-r-2"
            :class="hasActions ? 'rounded-tl-md rounded-tr-md' : 'rounded-md border-b-2'"
          >
            <div class="grid gap-6">
              <slot name="form" />
            </div>
          </div>

          <div v-if="hasActions" class="flex items-center justify-end px-4 py-3 text-right sm:px-6 border-gray-300 border-l-2 border-r-2 border-b-2 rounded-bl-md rounded-br-md">
            <slot name="actions" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
