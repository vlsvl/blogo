<script>
import { defineComponent } from 'vue'
import { usePage, Link } from '@inertiajs/inertia-vue3'
import Dropdown from '@/Components/Dropdown'
import Icon from '@/Components/Icon'

export default defineComponent({
  name: 'UserDropdownMenu',

  components: {
    Dropdown,
    Link,
    Icon,
  },
  props: {
    iconColorClass: {
      type: String,
      default: 'text-gray-500',
    },
  },
  computed: {
    locales() {
      return usePage().props.value.locales
    },
    currentLocale() {
      return usePage().props.value.locale
    },
  },
})
</script>

<template>
  <div class="ml-3 relative">
    <dropdown align="right" width="48">
      <template #trigger>
        <button
          class="
            flex
            text-sm
            border-2 border-transparent
            rounded-full
            focus:outline-none focus:border-gray-300
            transition
          "
        >
          <div class="h-8 w-8 rounded-full object-cover">
            <icon name="globe" />
          </div>
        </button>
      </template>

      <template #content>
        <!-- Authentication -->
        <Link
          v-for="(locale, id) in locales"
          :key="id" :href="route('locale', id)"
          class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
          :class="{ 'text-red-600': id === currentLocale }"
        >
          {{ __(locale) }}
        </Link>
      </template>
    </dropdown>
  </div>
</template>
