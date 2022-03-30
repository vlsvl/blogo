<script setup>
import DialogModal from '@/Components/DialogModal'
import CButton from '@/Components/Form/Button'
import {ref} from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

const emit = defineEmits(['close'])

defineProps({
  show: {
    type: Boolean,
    default: false,
  },
})

function close() {
  emit('close')
}

// Settings search form
const query = ref('')

function handleChange() {
  if (query.value.length < 4) {
    return
  }
  axios.post(route('search'), null, {
    params: {
      query: query.value,
    },
  })
    .then(response => {
      content.value = response.data
      console.log('Content changed', content.value)
    })
}

// Content of search modal
const content = ref({})
</script>

<template>
  <div>
    <DialogModal :show="show" @close="close">
      <template #title>
        <input v-model="query" class="w-full rounded-lg" type="search" placeholder="Search here..." autofocus @input="handleChange" />
      </template>
      <template #content>
        <div v-if="content.posts?.length">
          <h3 class="text-gray-500">Posts</h3>
          <div v-for="item in content.posts" :key="item.id">
            <div><Link :href="route('posts.show', item.slug )">{{ item.title }}</Link></div>
          </div>
        </div>
        <div v-if="content.users?.length">
          <h3 class="text-gray-500">Users</h3>
          <div v-for="item in content.users" :key="item.id">
            <div><Link :href="route('users.show', item.id )">{{ item.name }}</Link></div>
          </div>
        </div>
      </template>
      <template #footer>
        <CButton @click="close">Close</CButton>
      </template>
    </DialogModal>
  </div>
</template>
