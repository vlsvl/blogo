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
    hasMessages() {
      return !!usePage().props.value.messages
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
            has-messages
          "
        >
          <div class="h-8 w-8 rounded-full object-cover">
            <icon name="user" />
          </div>
        </button>
      </template>

      <template #content>
        <!-- Account Management -->
        <dropdown-link v-if="signedIn" :href="route('profile', $page.props.auth.user?.id)">
          {{ __("Profile") }}
        </dropdown-link>

        <div class="border-t border-gray-100" />
        <!-- Authentication -->
        <dropdown-link v-if="signedIn" :href="route('dashboard')">
          {{ __("Dashboard") }}
        </dropdown-link>

        <div v-else>
          <dropdown-link v-if="canLogin" :href="route('login')">
            {{ __("Login") }}
          </dropdown-link>

          <dropdown-link v-if="canRegister" :href="route('register')">
            {{ __("Register") }}
          </dropdown-link>
        </div>

        <div v-if="signedIn" class="border-t border-gray-100" />

        <!-- Authentication -->
        <dropdown-link v-if="signedIn" :href="route('logout')" method="POST" as="button"> {{ __("Log Out") }} </dropdown-link>
      </template>
    </dropdown>
  </div>
</template>

<style>
  .has-messages::after {
    content: '';
    display: block;
    height: 5px;
    width: 5px;
    position: absolute;
    top: 5px;
    right: 5px;
  }
</style>
