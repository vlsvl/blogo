<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  links: Array,
})
</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links">
        <div
          v-if="link.url === null"
          :key="key"
          class="
            mr-1
            mb-1
            px-4
            py-3
            text-sm
            leading-4
            text-gray-400
            border
            rounded
          "
          v-html="link.label"
        />
        <Link
          v-else
          :key="'else' + key"
          class="
            mr-1
            mb-1
            px-4
            py-3
            text-sm
            leading-4
            border
            rounded
            hover:bg-white
            focus:border-indigo-500 focus:text-indigo-500
          "
          :class="{ 'bg-blue-200': link.active}"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>
