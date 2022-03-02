<script setup>
import AdminLayout from '@/Layouts/Admin.vue'
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
  user: Object,
})

const fields = ['id', 'name', 'email', 'created_at', 'updated_at', 'email_verified_at']
</script>

<template>
  <AdminLayout :title="user.name">
    <template #header>
      {{ __("User: :name", { name: user.name}) }}
    </template>
    <div class="container max-w-5xl mx-auto shadow-xl rounded-xl p-4 lg:p-6">
      <div class="px-4 py-6 flex">
        <Link
          :href="route('users.auth_as', user.id)"
          class="btn btn-primary mr-4"
        >
          {{ __('Authorize as...') }}
        </Link>
        <form :action="route('users.destroy', user.id)" method="post">
          <button type="submit" class="btn btn-danger">{{ __("Delete user") }}</button>
        </form>
      </div>
      <div class="text-gray-700">
        <div class="text-md">
          <div v-for="(field, id) in fields" :key="id" class="grid grid-cols-2">
            <div class="px-4 py-2 font-semibold">{{ __('User ' + field) }}:</div>
            <div class="px-4 py-2">{{ user[field] }}</div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
