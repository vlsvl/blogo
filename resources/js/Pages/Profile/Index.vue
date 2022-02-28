<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
import AdminLayout from '@/Layouts/Admin'
import ProfileInfoForm from './Partials/ProfileInfoForm'
import UpdatePasswordForm from './Partials/UpdatePasswordForm'
import DeleteProfileForm from './Partials/DeleteProfileForm'

const user = computed({
  get () {
    return usePage().props.value.auth.user
  },
})
</script>

<template>
  <AdminLayout title="User Profile">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        User Profile
      </h2>
    </template>

    <ProfileInfoForm :user="user" />

    <UpdatePasswordForm />

    <DeleteProfileForm />
  </AdminLayout>
</template>

