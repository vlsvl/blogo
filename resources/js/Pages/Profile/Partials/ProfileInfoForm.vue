<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import CButton from '@/Components/Form/Button.vue'
import FormSection from '@/Components/Form/FormSection.vue'
import CInput from '@/Components/Form/Input.vue'
import CInputError from '@/Components/Form/InputError.vue'
import CLabel from '@/Components/Form/Label.vue'
import ActionMessage from '@/Components/Form/ActionMessage.vue'

const props = defineProps({
  user: Object,
})

const form = useForm({
  name: props.user.name,
  email: props.user.email,
})

function updateProfileInfo () {
  form.post(route('profile.updateCurrentInfo'), {
    errorBag: 'profileInfo',
    preserveScroll: true,
  })
}
</script>

<template>
  <FormSection @submitted="updateProfileInfo">
    <template #title>
      Profile Information
    </template>

    <template #description>
      Update your account's profile information and email address.
    </template>

    <template #form>
      <!-- Profile Photo -->
      <div class="col-span-6 sm:col-span-4">
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4 mb-4">
          <CLabel for="name" value="Name" />
          <CInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autocomplete="name" />
          <CInputError :message="form.errors.name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
          <CLabel for="email" value="Email" />
          <CInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
          <CInputError :message="form.errors.email" class="mt-2" />
        </div>
      </div>
    </template>

    <template #actions>
      <ActionMessage :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </ActionMessage>

      <CButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Save
      </CButton>
    </template>
  </FormSection>
</template>
