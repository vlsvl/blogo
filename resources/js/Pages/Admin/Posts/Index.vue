<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import IndexPage from '@/Components/Admin/IndexPage.vue'
import { Link } from '@inertiajs/inertia-vue3'

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
    name: 'updated_at',
    title: 'Updated',
  },
  {
    name: 'user',
    title: 'User',
  },
]

const actions = [
  {
    condition: 'posted_at|notempty',
    route: 'public.post.show',
    type: 'view',
    param: 'slug',
    color: 'btn-primary',
  },
  {
    route: 'posts.edit',
    type: 'edit',
    param: 'slug',
    color: 'btn-success',
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
      :actions="actions"
    >
      <template #buttons>
        <Link :href="route('posts.create')" class="btn btn-primary">Create post</Link>
      </template>
    </IndexPage>
  </AdminLayout>
</template>
