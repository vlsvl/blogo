<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import CButton from '@/Components/Form/Button.vue'
import FormSection from '@/Components/Form/FormSection.vue'
import CSelect from '@/Components/Form/Select.vue'
import CInputError from '@/Components/Form/InputError.vue'
import CLabel from '@/Components/Form/Label.vue'
import ActionMessage from '@/Components/Form/ActionMessage.vue'
import { computed } from 'vue'

const props = defineProps({
  user: Object,
  role: Number,
  roles: Array,
})

console.log(props.role)

const form = useForm({
  role_id: props.role.id,
})

const options = computed(() => {
  return props.roles.map((role) => {
    return {
      value: role.id,
      title: role.title,
      selected: role.id === props.role,
    }
  })
})

function changeRole() {
  form.patch(route('users.change_role', props.user.id ), {
    errorBag: 'changeRole',
    preserveScroll: true,
  })
}
</script>

<template>
  <div class="mt-6">
    <FormSection @submitted="changeRole">
      <template #title>
        User role
      </template>

      <template #description>
        Update user role.
      </template>

      <template #form>
        <div class="col-span-6 sm:col-span-4">
          <!-- Role -->
          <div class="col-span-6 sm:col-span-4 mb-4">
            <CLabel for="role" value="Role" />
            <CSelect id="role" v-model="form.role_id" :options="options" class="mt-1 block w-full" />
            <CInputError :message="form.errors.role_id" class="mt-2" />
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
  </div>
</template>
