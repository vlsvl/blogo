<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import UserDropdownMenu from '@/Components/UserDropdownMenu'

defineProps({
  title: {
    type: String,
    default: 'Title',
  },
})

const navLinks = [
  {
    route: 'home',
    title: 'Home',
    active: true,
  },
  {
    route: 'category',
    title: 'Category',
  },
  {
    route: 'about',
    title: 'About',
  },
]
</script>

<template>
  <div class="min-h-screen w-full flex flex-col">
    <Head :title="title" />
    <!-- Header start -->
    <nav
      class="w-full mx-auto flex justify-between items-center border-t-8 border-main-blue"
    >
      <!-- Logo -->
      <span class="block text-3xl p-4">BLogo</span>
      <!-- End Logo -->
      <!-- Nav Bar -->
      <div class="flex w-full justify-center h-18">
        <div
          v-for="(link,id) in navLinks" :key="id"
          class="link"
          :class="{ active: link.active }"
        >
          <Link :href="link.route">{{ link.title }}</Link>
        </div>
      </div>
      <!-- End Nav Bar -->
      <!-- User Menu -->
      <user-dropdown-menu class="p-4 text-main-blue" />
      <!-- End User Menu -->
    </nav>
    <!-- Header end -->
    <slot />
    <!-- Footer start -->
    <footer class="mt-24 bg-gradient-to-b from-white to-blue-300">
      <div class="container mx-auto px-8">
        <div class="w-full flex flex-col md:flex-row py-6 justify-start">
          <div class="flex-1 mb-6 text-black">
            <a
              class="
                text-main-blue
                no-underline
                hover:no-underline
                font-bold
                text-2xl
                lg:text-4xl
              "
              href="/"
            >
              BLOGO
            </a>
          </div>
          <div class="flex-1">
            <ul class="list-reset mb-6 flex flex-row">
              <li v-for="(link,id) in navLinks" :key="id" class="mt-2 inline-block mr-2 px-4 md:block md:mr-0">
                <Link
                  href="#"
                  class="
                    text-xl
                    hover:underline
                    text-gray-800
                    hover:text-main-blue
                  "
                >
                  {{ link.title }}
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer end -->
  </div>
</template>

<style scoped>
.link {
  font-size: 1.25rem;
  font-weight: bold;
  padding: 1rem 1.25rem 1rem 1.25rem;
  position: relative;
  height: 68px;
}
.link:hover {
  text-decoration: underline;
}
.active.link {
  color: white;
  background: #0081cc;
  border-radius: 0% 0% 30px 30px;
}
.active.link::before {
  content: "";
  position: absolute;
  left: -30px;
  top: 0;
  height: 30px;
  width: 30px;
  background: white;
  border-radius: 50%;
  box-shadow: 15px -15px 0 #0081cc;
}
.active.link::after {
  content: "";
  position: absolute;
  right: -30px;
  top: 0;
  height: 30px;
  width: 30px;
  background: white;
  border-radius: 50%;
  box-shadow: -15px -15px 0 #0081cc;
}
</style>
