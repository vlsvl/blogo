<template>
  <Link :href="href" :class="classes">
    <icon :name="icon" />
    <slot />
  </Link>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Components/Icon'

export default defineComponent({
  components: {
    Link,
    Icon,
  },
  props: {
    href: String,
    active: Boolean,
    icon: String,
  },
  computed: {
    classes() {
      return this.active
        ? 'flex text-main-blue hover:text-blue-600 text-sm uppercase py-3 font-bold block'
        : ' flex text-gray-600 hover:text-main-blue text-sm uppercase py-3 font-bold block'
    },
  },
})
</script>
