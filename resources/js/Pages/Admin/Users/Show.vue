<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'
import Collapse from '@/Components/Collapse'
import ChangeRoleForm from './Partials/ChangeRoleForm'

const props = defineProps({
  user: Object,
  roles: Array,
})

const fields = ['id', 'name', 'email', 'created_at', 'updated_at', 'email_verified_at', 'role_title']

const form = useForm({
  id: props.user.id,
})

function remove() {
  if (confirm('Are you sure to delete this user?')) {
    form.delete(route('users.destroy', props.user.id))
  }
}
</script>

<template>
  <AdminLayout :title="user.name">
    <template #header>
      {{ __("User: :name", { name: user.name}) }}
    </template>
    <div class="container max-w-4xl mx-auto shadow-xl rounded-xl p-4 lg:p-6">
      <div class=" py-6 flex justify-between border-b-2 mb-6">
        <div>
          <Link
            :href="route('users.index')"
            class="btn btn-primary"
          >
            {{ __("Back to list") }}
          </Link>
        </div>
        <div class="flex">
          <Link
            :href="route('users.auth_as', user.id)"
            class="btn btn-primary mr-4"
          >
            {{ __('Authorize as...') }}
          </Link>
          <form :action="route('users.destroy', user.id)" method="post" @submit.prevent="remove">
            <button type="submit" class="btn btn-danger">{{ __("Delete user") }}</button>
          </form>
        </div>
      </div>
      <div class="text-gray-700 mb-6">
        <div class="text-md">
          <div v-for="(field, id) in fields" :key="id" class="grid grid-cols-2">
            <div class="py-2 font-semibold">{{ __('User ' + field) }}:</div>
            <div class="py-2">{{ user[field] }}</div>
          </div>
        </div>
      </div>
      <Collapse>
        <template #header>
          {{ __("Change user role") }}
        </template>

        <template #content>
          <ChangeRoleForm :user="user" :role="user.role_id" :roles="roles" />
        </template>
      </Collapse>
    </div>
  </AdminLayout>
</template>
