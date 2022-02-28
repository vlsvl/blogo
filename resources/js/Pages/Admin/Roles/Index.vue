<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import IndexPage from '@/Components/Admin/IndexPage.vue'
defineProps({
  roles: Object,
})

const headers = [
  {
    name: 'id',
    title: '#',
  },
  {
    name: 'name',
    title: 'Name',
  },
  {
    name: 'title',
    title: 'Title',
  },
  {
    name: 'description',
    type: 'Description',
  },
]
</script>

<template>
  <AdminLayout title="Roles">
    <template #header>
      Roles list
    </template>
    <IndexPage
      :headers="headers"
      :content="roles"
    />
  </AdminLayout>
</template>
