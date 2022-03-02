<script setup>
import { computed, useSlots } from 'vue'
import CTable from '@/Components/Admin/Table.vue'
import CPagination from '@/Components/Admin/Pagination.vue'
defineProps({
  headers: Array,
  content: Object,
  actions: {
    type: Array,
    default: () => [],
  },
})

const hasButtons = computed({
  get () {
    return !! useSlots().buttons
  },
})
</script>

<template>
  <div class="w-full mb-12">
    <div
      class="
        relative
        flex flex-col
        min-w-0
        break-words
        bg-white
        w-full
        mb-6
        shadow-lg
        rounded
      "
    >
      <slot name="filter" class="mb-6" />
      <div v-if="hasButtons" class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center justify-end">
          <slot name="buttons" />
        </div>
      </div>
      <div class="block w-full overflow-x-auto">
        <!-- Projects table -->
        <CTable :headers="headers" :rows="content.data" :actions="actions" />
        <div class="p-3">
          <CPagination :links="content.links" />
        </div>
      </div>
    </div>
  </div>
</template>
