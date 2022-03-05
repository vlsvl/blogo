<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Components/Icon.vue'
const props = defineProps({
  actions: {
    type: Array,
    default: () => [],
  },
  item: Object,
})

console.log(props)
</script>

<template>
  <div class="flex px-4 lg:p-0">
    <Link
      v-for="(action,aid) in actions"
      :key="aid" class="btn text-white p-2 mr-2"
      :class="action.color"
      :href="route(action.route, item[action.param])"
    >
      <Icon :name="action.type" />
    </Link>
  </div>
</template>
