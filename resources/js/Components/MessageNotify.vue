<script setup>
import { usePage, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Components/Icon'
import {computed} from 'vue'

const unreadMessages = computed(() => {
  return usePage().props.value.unreadMessage
})
console.log('messages', unreadMessages)
</script>

<template>
  <div class="ml-3 relative text-white mr-3">
    <Link
      class="
        flex
        text-sm
        text-white
        border-2 border-transparent
        rounded-full
        focus:outline-none focus:border-gray-300
        transition
        has-messages
        hover:text-white
      "
      :href="route('messages.index')"
    >
      <div class="h-8 w-8 rounded-full object-cover">
        <Icon name="bell" />
      </div>
    </Link>
    <span class="messageCounter" :class="{ hide: unreadMessages <= 0 }">{{ unreadMessages }}</span>
  </div>
</template>

<style>
.messageCounter {
  cursor: none;
  display: block;
  font-size: .7rem;
  font-weight: bold;
  line-height: 1rem;
  background: red;
  padding: 2px 4px;
  border-radius: 50%;
  position: absolute;
  width: 18px;
  height: 18px;
  top: 3px;
  text-align: center;
  right: 3px;
}
.hide {
  display: none;
}
</style>
