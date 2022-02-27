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
          <img
            v-if="$page.props.user?.profile_photo_url"
            class="h-8 w-8 rounded-full object-cover"
            :src="$page.props.user?.profile_photo_url ? 'photo' : ''"
            :alt="$page.props.user?.name"
          />
          <div v-else class="h-8 w-8 rounded-full object-cover">
            <icon name="user" class="w-full {{ iconColorClass }}" />
          </div>
        </button>
      </template>

      <template #content>
        <!-- Account Management -->
        <!-- <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div> -->

        <dropdown-link v-if="signedIn" :href="route('profile.show')">
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

        <div class="border-t border-gray-100" />

        <!-- Authentication -->
        <form v-if="signedIn" @submit.prevent="logout">
          <dropdown-link as="button"> Log Out </dropdown-link>
        </form>
      </template>
    </dropdown>
  </div>
</template>

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
      console.log(usePage().props.value)
      return usePage().props.value.canLogin
    },
    canRegister() {
      return usePage().props.value.canRegister
    },
    signedIn() {
      return !!usePage().props.value.user
    },
  },

  methods: {
    logout() {
      this.$inertia.post(route('logout'))
    },
  },
}
</script>
