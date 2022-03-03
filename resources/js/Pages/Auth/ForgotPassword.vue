<script setup>
import CButton from '@/Components/Form/Button.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import CInput from '@/Components/Form/Input.vue'
import CInputError from '@/Components/Form/InputError.vue'
import CLabel from '@/Components/Form/Label.vue'
import { Head, useForm } from '@inertiajs/inertia-vue3'

defineProps({
  status: String,
})

const form = useForm({
  email: '',
})

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <GuestLayout>
    <Head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600">
      Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <CLabel for="email" value="Email" />
        <CInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus autocomplete="username" />
        <CInputError :message="form.errors.email" class="mt-2" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <CButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Email Password Reset Link
        </CButton>
      </div>
    </form>
  </GuestLayout>
</template>
