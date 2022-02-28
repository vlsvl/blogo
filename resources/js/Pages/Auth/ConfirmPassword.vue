<script setup>
import CButton from '@/Components/Form/Button.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import CInput from '@/Components/Form/Input.vue'
import CLabel from '@/Components/Form/Label.vue'
import { useForm } from '@inertiajs/inertia-vue3'

const form = useForm({
  password: '',
})

const submit = () => {
  form.post(route('password.confirm'), {
    onFinish: () => form.reset(),
  })
}
</script>

<template>
  <GuestLayout title="Confirm Password">
    <div class="mb-4 text-sm text-gray-600">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="submit">
      <div>
        <CLabel for="password" value="Password" />
        <CInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required autocomplete="current-password" autofocus />
      </div>

      <div class="flex justify-end mt-4">
        <CButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Confirm
        </CButton>
      </div>
    </form>
  </GuestLayout>
</template>
