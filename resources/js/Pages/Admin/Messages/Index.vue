<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
const props = defineProps({
  messages: Array,
})

function setRead() {

}
</script>

<template>
  <AdminLayout title="Messages">
    <template #header>
      Messages list
    </template>

    <div class="p-4">
      <div v-for="(message, key) in messages" :key="key" class="shadow-lg p-4 mb-4" :class="{'border-red-300 border-2': !message.read}">
        <div class="font-bold">{{ message.title }}</div>
        <div>{{ message.content }}</div>
      </div>
    </div>
  </AdminLayout>
</template>
