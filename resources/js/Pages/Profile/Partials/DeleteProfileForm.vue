<script setup>
import ActionMessage from '@/Components/Form/ActionMessage.vue'
import CButton from '@/Components/Form/Button.vue'
import FormSection from '@/Components/Form/FormSection.vue'
import CInput from '@/Components/Form/Input.vue'
import CInputError from '@/Components/Form/InputError.vue'
import CLabel from '@/Components/Form/Label.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'

const current_passwordInput = ref(null)

const form = useForm({
  current_password: '',
})


function deleteProfile () {
  form.post(route('profile.deleteCurrentProfile'), {
    errorBag: 'deleteProfile',
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.current_password) {
        form.reset('current_password')
        current_passwordInput.value.focus()
      }
    },
  })
}
</script>

<template>
  <FormSection warning="true" @submitted="deleteProfile">
    <template #title>
      Delete profile
    </template>

    <template #description>
      <span class="text-red-600">
        Delete you profile by password confirmation. All profile information was removed.
      </span>
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <CLabel for="current_password" value="Current Password" />
        <CInput id="current_password" ref="current_passwordInput" v-model="form.current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        <CInputError :message="form.errors.current_password" class="mt-2" />
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
