<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import IndexPage from '@/Components/Admin/IndexPage.vue'
import CLabel from '@/Components/Form/Label.vue'
import CInput from '@/Components/Form/Input.vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  posts: Object,
  filters: Object,
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

const form = useForm({
  search: props.filters.search || '',
})

function filter() {
  form.get(route('posts.index'))
}
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
      <template #filter>
        <form action="route('comments.index')" class="shadow-md p-4 mb-6" method="post" @submit.prevent="filter">
          <div class="md:grid md:grid-cols-2 w-full">
            <div class="flex items-center md:mr-3 mb-3 md:mb-0">
              <CLabel for="search" class="text-lg mr-3" value="Search:" />
              <CInput id="search" v-model="form.search" type="text" class="block" />
            </div>
            <div class="col-span-2 mt-3 flex justify-end">
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
          </div>
        </form>
      </template>
      <template #buttons>
        <Link :href="route('posts.create')" class="btn btn-primary">Create post</Link>
      </template>
    </IndexPage>
  </AdminLayout>
</template>
