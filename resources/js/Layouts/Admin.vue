<script setup>
import {ref} from 'vue'
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import IconLink from '@/Components/Admin/IconLink'
import Collapse from '@/Components/Admin/IconCollapse'
import UserDropdownMenu from '@/Components/UserDropdownMenu'
import FlashMessages from '@/Components/FlashMessages.vue'
import LocaleSwitch from '@/Components/Admin/LocaleSwitch'
import {useActive} from '@/Composable/route_active'
import {adminLinks} from '@/params'
import Search from '@/Components/Admin/Search'

defineProps({
  title: String,
})

const sidebarOpen = ref(false)

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

const {isActive} = useActive()

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value
}
// Search modal settings
const showModal = ref(false)
function close () {
  showModal.value = !showModal.value
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
      :class="{ 'hidden lg:block': !sidebarOpen }"
    >
      <div
        class="
        md:items-start md:min-h-full md:flex-nowrap
        px-0
        flex flex-col flex-wrap
        w-full
      "
      >
        <ul v-if="adminLinks.length" class="md:min-w-full flex flex-col list-none">
          <li v-for="(link, id) in adminLinks" :key="id" class="items-center">
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
          <div class="flex items-center">
            <button
              class="mr-2 relative w-10 h-10 py-2 text-white focus:outline-none focus:shadow-outline lg:hidden"
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
            <Link
              class="text-white text-xl inline-block font-semibold"
              :href="route('home')"
            >
              BLogo
            </Link>
          </div>
          <!-- User -->
          <div class="flex list-none items-center">
            <button
              class="mr-2 relative w-10 h-10 py-2 text-white focus:outline-none focus:shadow-outline"
              aria-expanded="true" aria-controls="sidebar"
              @click="showModal = !showModal"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
            <LocaleSwitch class="text-white mr-3" />
            <UserDropdownMenu class="text-white" />
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
        <!-- Flashes -->
        <div class="my-4">
          <FlashMessages />
        </div>
        <!-- End Flashes -->
        <!-- Search Modal -->
        <Search :show="showModal" @close="close" />
        <!-- End Search Modal -->
        <slot />
        <!-- End Page Content -->
      </main>
      <!-- End Page Container -->
    </div>
    <!-- End Main Container -->
  </div>
</template>
