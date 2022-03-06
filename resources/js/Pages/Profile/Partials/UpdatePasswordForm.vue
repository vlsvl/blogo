<script setup>
import ActionMessage from '@/Components/Form/ActionMessage.vue'
import CButton from '@/Components/Form/Button.vue'
import FormSection from '@/Components/Form/FormSection.vue'
import SectionWrapper from '@/Components/Form/SectionWrapper.vue'
import CInput from '@/Components/Form/Input.vue'
import CInputError from '@/Components/Form/InputError.vue'
import CLabel from '@/Components/Form/Label.vue'
import {useForm} from '@inertiajs/inertia-vue3'
import {ref} from 'vue'

const current_passwordInput = ref(null)
const passwordInput = ref(null)

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})


function updateProfilePassword() {
  form.post(route('profile.updateCurrentPassword'), {
    errorBag: 'updatePassword',
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation')
        passwordInput.value.focus()
      }
      if (form.errors.current_password) {
        form.reset('current_password')
        current_passwordInput.value.focus()
      }
    },
  })
}
</script>

<template>
  <SectionWrapper>
    <FormSection @submitted="updateProfilePassword">
      <template #title>
        Update Password
      </template>

      <template #description>
        Ensure your account is using a long, random password to stay secure.
      </template>

      <template #form>
        <div class="col-span-6 sm:col-span-4">
          <CLabel for="current_password" value="Current Password" />
          <CInput
            id="current_password" ref="current_passwordInput" v-model="form.current_password" type="password"
            class="mt-1 block w-full" autocomplete="current-password"
          />
          <CInputError :message="form.errors.current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
          <CLabel for="password" value="New Password" />
          <CInput
            id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full"
            autocomplete="new-password"
          />
          <CInputError :message="form.errors.password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
          <CLabel for="password_confirmation" value="Confirm Password" />
          <CInput
            id="password_confirmation" v-model="form.password_confirmation" type="password"
            class="mt-1 block w-full" autocomplete="new-password"
          />
          <CInputError :message="form.errors.password_confirmation" class="mt-2" />
        </div>
      </template>

      <template #actions>
        <ActionMessage :on="form.recentlySuccessful" class="mr-3">
          Saved.
        </ActionMessage>

        <CButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Update
        </CButton>
      </template>
    </FormSection>
  </SectionWrapper>
</template>
