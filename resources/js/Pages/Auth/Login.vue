<script setup>
import CButton from '@/Components/Form/Button.vue'
import CCheckbox from '@/Components/Form/Checkbox.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import CInput from '@/Components/Form/Input.vue'
import CLabel from '@/Components/Form/Label.vue'
import { Link, useForm } from '@inertiajs/inertia-vue3'

defineProps({
  canResetPassword: Boolean,
  status: String,
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <GuestLayout title="Log in">
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div>
        <CLabel for="email" value="Email" />
        <CInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus autocomplete="username" />
      </div>

      <div class="mt-4">
        <CLabel for="password" value="Password" />
        <CInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="current-password" />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <CCheckbox v-model:checked="form.remember" name="remember" />
          <span class="ml-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
          Forgot your password?
        </Link>

        <CButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Log in
        </CButton>
      </div>
    </form>
  </GuestLayout>
</template>
