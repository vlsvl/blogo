<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/inertia-vue3'
import IconLink from '@/Components/Admin/IconLink'
import Collapse from '@/Components/Admin/IconCollapse'
import UserDropdownMenu from '@/Components/UserDropdownMenu'
import FlashMessages from '@/Components/FlashMessages.vue'
import { useActive } from '@/Composable/route_active'

const links = [
  {
    type: 'link',
    route: 'dashboard',
    title: 'dashboard',
    icon: 'speedometer',
  },
  {
    type: 'collapse',
    title: 'Manage users',
    collapsed: true,
    icon: 'users',
    pages: [
      {
        type: 'link',
        route: 'users.index',
        title: 'users',
      },
      {
        type: 'link',
        route: 'roles.index',
        title: 'roles',
      },
    ],
  },
]

defineProps({
  title: String,
})

const sidebarOpen = ref(true)

const isCollapsed = (links) => {
  let isCollapsed = true
  links.forEach(link => {
    if (route().current(link.route)) {
      isCollapsed = false
    }
    if (route().current(link.route.split('.')[0] + '*')) {
      isCollapsed = false
    }
  })
  return isCollapsed
}

const { isActive } = useActive()

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}

</script>

<template>
  <div class="flex">
    <Head :title="title" />
    <!-- Sidebar -->
    <nav
      class="
      md:overflow-y-auto
      z-10
      fixed
      h-full
      top-20
      left-0
      shadow-xl
      bg-white
      flex flex-shrink-0
      w-64
      py-4
      px-6
      lg:flex
      lg:top-0
      transition-all
      ease-in
      duration-200
    "
      :class="{ 'hidden': !sidebarOpen }"
    >
      <div
        class="
        md:items-start md:min-h-full md:flex-nowrap
        px-0
        flex flex-col flex-wrap
        w-full
      "
      >
        <ul v-if="links.length" class="md:min-w-full flex flex-col list-none">
          <li v-for="(link, id) in links" :key="id" class="items-center">
            <!-- Simple link -->
            <icon-link
              v-if="link.type === 'link'"
              :href="route(link.route)"
              :active="route().current(link.route)"
              :icon="link.icon"
            >
              {{ link.title }}
            </icon-link>
            <!-- Collapsed links block -->
            <collapse
              v-if="link.type === 'collapse'"
              :title="link.title"
              :collapsed="isCollapsed(link.pages)"
              :icon="link.icon"
            >
              <ul
                v-if="link.pages.length"
                class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
              >
                <li
                  v-for="(page, i) in link.pages"
                  :key="i"
                  class="inline-flex pl-2"
                >
                  <icon-link
                    :href="route(page.route)"
                    :active="isActive(page)"
                  >
                    {{ page.title }}
                  </icon-link>
                </li>
              </ul>
            </collapse>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Sidebar -->
    <!-- Main container -->
    <div class="w-full lg:ml-64">
      <!-- Navbar -->
      <nav
        class="w-full sticky top-0 z-10 bg-main-blue flex-row flex-nowrap justify-start flex items-center p-4"
      >
        <div
          class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap"
        >
          <button
            class="mr-2 relative w-10 h-10 py-2 text-red-600 focus:outline-none focus:shadow-outline lg:hidden"
            aria-expanded="true" aria-controls="sidebar"
            @click.prevent="toggleSidebar"
          >
            <svg
              :class="{'hidden': sidebarOpen}"
              class="absolute inset-0 mt-2 ml-2 w-6 h-6"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <line x1="3" y1="12" x2="21" y2="12" />
              <line x1="3" y1="6" x2="21" y2="6" />
              <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
            <svg
              :class="{'hidden': !sidebarOpen}"
              class="absolute inset-0 mt-2 ml-2 w-6 h-6"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <line x1="18" y1="6" x2="6" y2="18" />
              <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
          </button>
          <!-- Brand -->
          <a
            class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
            href="https://www.creative-tim.com/learning-lab/tailwind-starter-kit#/dashboard"
          >
            {{ title }}
          </a>
          <!-- Form -->
          <form
            class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"
          >
            <div class="relative flex w-full flex-wrap items-stretch">
              <span
                class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
              >
                <i class="fas fa-search" />
              </span>
              <input
                type="text"
                placeholder="Search here..."
                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
              />
            </div>
          </form>
          <!-- User -->
          <div class="flex-col md:flex-row list-none items-center flex">
            <user-dropdown-menu class="text-white" />
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- Page Container -->
      <main class="px-4 md:px-6 w-full">
        <!-- Page Content -->

        <!-- Page Heading -->
        <header v-if="$slots.header">
          <div class="py-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              <slot name="header" />
            </h2>
          </div>
        </header>
        <!-- End Page Heading -->
        <div class="my-4">
          <flash-messages />
        </div>
        <!-- Page Content -->
        <slot />
        <!-- End Page Content -->
      </main>
      <!-- End Page Container -->
    </div>
    <!-- End Main Container -->
  </div>
</template>
