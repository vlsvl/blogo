<script setup>
import CButton from '@/Components/Form/Button.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import CInput from '@/Components/Form/Input.vue'
import CLabel from '@/Components/Form/Label.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  email: String,
  token: String,
})

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('password.update'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Reset Password" />

    <form @submit.prevent="submit">
      <div>
        <CLabel for="email" value="Email" />
        <CInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus autocomplete="username" />
      </div>

      <div class="mt-4">
        <CLabel for="password" value="Password" />
        <CInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
      </div>

      <div class="mt-4">
        <CLabel for="password_confirmation" value="Confirm Password" />
        <CInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <CButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Reset Password
        </CButton>
      </div>
    </form>
  </GuestLayout>
</template>
