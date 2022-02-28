<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import AdminLayout from '@/Layouts/Admin.vue'
import IndexPage from '@/Components/Admin/IndexPage.vue'
import CButton from '@/Components/Form/Button.vue'
import CLabel from '@/Components/Form/Label.vue'
import CInput from '@/Components/Form/Input.vue'
const props = defineProps({
  users: Object,
  filters: Object,
})

const form = useForm({
  search: props.filters.search,
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
    name: 'email',
    title: 'Email',
  },
  {
    name: 'role',
    type: 'badge',
    title: 'Role',
  },
]

function filter() {
  form.get(route('users.index'))
}
</script>

<template>
  <AdminLayout title="Users">
    <template #header>
      Users list
    </template>
    <IndexPage
      :headers="headers"
      :content="users"
    >
      <template #filter>
        <form action="route('users.index')" method="post" @submit.prevent="filter">
          <div class="flex p-4 mb-6 shadow-md">
            <div class="row">
              <div class="columns-5xl flex items-center">
                <CLabel for="search" class="text-xl mr-3" value="Search:" />
                <CInput id="search" v-model="form.search" type="text" class="block mr-3" />
              </div>
            </div>
            <CButton type="submit">Filter</CButton>
          </div>
        </form>
      </template>
      <!-- <template #buttons>
      </template> -->
    </IndexPage>
  </AdminLayout>
</template>
