<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import IndexPage from '@/Components/Admin/IndexPage.vue'
import {useForm, usePage} from '@inertiajs/inertia-vue3'
import CLabel from '@/Components/Form/Label.vue'
import CInput from '@/Components/Form/Input.vue'
import Datepicker from 'vue3-date-time-picker'

import 'vue3-date-time-picker/dist/main.css'

const props = defineProps({
  comments: Object,
  filters: Object,
})

console.log('Props ', props)

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

const form = useForm({
  search: props.filters?.search || '',
  created_at: props.filters?.created_at || [],
})

function filter() {
  form.get(route('comments.index'))
}
</script>

<template>
  <AdminLayout title="Posts">
    <template #header>
      Posts list
    </template>
    <IndexPage
      :headers="headers"
      :content="comments"
    >
      <template #filter>
        <form action="route('comments.index')" class="shadow-md p-4 mb-6" method="post" @submit.prevent="filter">
          <div class="md:grid md:grid-cols-2 w-full">
            <div class="flex items-center md:mr-3 mb-3 md:mb-0">
              <CLabel for="search" class="text-lg mr-3" value="Search:" />
              <CInput id="search" v-model="form.search" type="text" class="block" />
            </div>
            <div class="flex items-center mb-3 md:mb-0">
              <CLabel for="created_at" class="text-lg mr-3" value="Commented:" />
              <Datepicker
                v-model="form.created_at"
                :locale="usePage().props.value.locale"
                clearable auto-apply range :enable-time-picker="false" format="dd.MM.yyyy"
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 w-full focus:ring-opacity-50 rounded-md shadow-sm"
              />
            </div>
            <div class="col-span-2 mt-3 flex justify-end">
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
          </div>
        </form>
      </template>
    </IndexPage>
  </AdminLayout>
</template>
