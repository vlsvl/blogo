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

function checkCondition(condition, item) {
  if (!condition) {
    return true
  }
  const split = condition.split('|')
  const param = split[0]
  const rule = split[1]
  switch(rule) {
  case ('notempty'):
    return item[param].length !== 0
  case('notnull'):
    return item[param]
  }
}

</script>

<template>
  <div class="flex px-4 lg:p-0 justify-end">
    <button v-for="(action,id) in actions" :key="id">
      <Link
        v-if="checkCondition(action.condition, item)"
        class="btn text-white p-2 mr-2"
        :class="action.color"
        :href="route(action.route, item[action.param])"
      >
        <Icon :name="action.type" />
      </Link>
    </button>
  </div>
</template>
