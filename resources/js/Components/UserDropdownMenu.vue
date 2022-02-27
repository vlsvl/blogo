<script>
import { usePage } from '@inertiajs/inertia-vue3'
import Dropdown from '@/Components/Dropdown'
import DropdownLink from '@/Components/DropdownLink'
import Icon from '@/Components/Icon'

export default {
  name: 'UserDropdownMenu',

  components: {
    Dropdown,
    DropdownLink,
    Icon,
  },
  props: {
    iconColorClass: {
      type: String,
      default: 'text-gray-500',
    },
  },
  computed: {
    canLogin() {
      return usePage().props.value.auth.canLogin
    },
    canRegister() {
      return usePage().props.value.auth.canRegister
    },
    signedIn() {
      return !!usePage().props.value.auth.user
    },
  },
}
</script>

<template>
  <div class="ml-3 relative">
    <dropdown align="right" width="48">
      <template #trigger>
        <button
          class="
            flex
            text-sm
            border-2 border-transparent
            rounded-full
            focus:outline-none focus:border-gray-300
            transition
          "
        >
          <div class="h-8 w-8 rounded-full object-cover">
            <icon name="user" />
          </div>
        </button>
      </template>

      <template #content>
        <!-- Account Management -->
        <!-- <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div> -->

        <dropdown-link v-if="signedIn" :href="route('profile', $page.props.auth.user?.id)">
          Profile
        </dropdown-link>

        <div class="border-t border-gray-100" />
        <!-- Authentication -->
        <dropdown-link v-if="signedIn" :href="route('dashboard')">
          Dashboard
        </dropdown-link>

        <div v-else>
          <dropdown-link v-if="canLogin" :href="route('login')">
            Login
          </dropdown-link>

          <dropdown-link v-if="canRegister" :href="route('register')">
            Register
          </dropdown-link>
        </div>

        <div v-if="signedIn" class="border-t border-gray-100" />

        <!-- Authentication -->
        <dropdown-link v-if="signedIn" :href="route('logout')" method="POST" as="button"> Log Out </dropdown-link>
      </template>
    </dropdown>
  </div>
</template>
