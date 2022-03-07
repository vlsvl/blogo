<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import IndexPage from '@/Components/Admin/IndexPage.vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  comments: Object,
})

const headers = [
  {
    name: 'id',
    title: '#',
  },
  {
    name: 'content',
    title: 'Comment',
  },
  {
    name: 'post_title',
    title: 'Post title',
  },
  {
    name: 'created_at',
    title: 'Created',
  },
  {
    name: 'user_name',
    title: 'User',
  },
]
//
// const actions = [
//   {
//     condition: 'posted_at|notempty',
//     route: 'public.post.show',
//     type: 'view',
//     param: 'slug',
//     color: 'btn-primary',
//   },
//   {
//     route: 'posts.edit',
//     type: 'edit',
//     param: 'slug',
//     color: 'btn-success',
//   },
// ]
</script>

<template>
  <AdminLayout title="Posts">
    <template #header>
      Posts list
    </template>
    <IndexPage
      :headers="headers"
      :content="comments"
      :actions="actions"
    />
  </AdminLayout>
</template>
