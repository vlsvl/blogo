<script setup>
import CButton from '@/Components/Form/Button.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import CInput from '@/Components/Form/Input.vue'
import CInputError from '@/Components/Form/InputError.vue'
import CLabel from '@/Components/Form/Label.vue'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form @submit.prevent="submit">
      <div>
        <CLabel for="name" value="Name" />
        <CInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
        <CInputError :message="form.errors.name" class="mt-2" />
      </div>

      <div class="mt-4">
        <CLabel for="email" value="Email" />
        <CInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autocomplete="username" />
        <CInputError :message="form.errors.email" class="mt-2" />
      </div>

      <div class="mt-4">
        <CLabel for="password" value="Password" />
        <CInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
        <CInputError :message="form.errors.password" class="mt-2" />
      </div>

      <div class="mt-4">
        <CLabel for="password_confirmation" value="Confirm Password" />
        <CInput id="password_confirmation" v-model="form.password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
        <CInputError :message="form.errors.password_confirmation" class="mt-2" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
          Already registered?
        </Link>

        <CButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Register
        </CButton>
      </div>
    </form>
  </GuestLayout>
</template>
