<script setup>
import AdminLayout from '@/Layouts/Admin'

defineProps({
  sessions: Array,
})
</script>

<template>
  <AdminLayout title="Profile">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile
      </h2>
    </template>
  </AdminLayout>
</template>

