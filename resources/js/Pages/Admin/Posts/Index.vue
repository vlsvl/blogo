<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import IndexPage from '@/Components/Admin/IndexPage.vue'

defineProps({
  posts: Object,
})

const headers = [
  {
    name: 'id',
    title: '#',
  },
  {
    name: 'title',
    title: 'Title',
  },
  {
    name: 'slug',
    title: 'Slug',
  },
  {
    name: 'user',
    title: 'User',
  },
]
</script>

<template>
  <AdminLayout title="Posts">
    <template #header>
      Posts list
    </template>
    <IndexPage
      :headers="headers"
      :content="posts"
    >
      <!-- <template #buttons>
      </template> -->
    </IndexPage>
  </AdminLayout>
</template>
