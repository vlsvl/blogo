<script setup>
import FlashMessages from '@/Components/FlashMessages'
import { Link, Head } from '@inertiajs/inertia-vue3'
import Wave from '@/Components/Public/Wave'
defineProps({
  title: String,
})
</script>

<template>
  <div class="min-h-screen relative bg-gradient-to-b from-white to-blue-300 overflow-hidden">
    <Head title="title" />
    <div class="flex flex-col justify-center items-center pt-24 relative z-20">
      <div>
        <Link href="/">
          <h2 class="text-4xl text-main-blue">BLogo</h2>
        </Link>
      </div>

      <FlashMessages class="mb-4" />

      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white opacity-80 shadow-xl overflow-hidden sm:rounded-xl">
        <h3 class="text-3xl text-center mb-6">{{ title }}</h3>
        <slot />
      </div>
    </div>
    <div class="lg:-mt-16 scale-150 md:scale-100">
      <Wave />
    </div>
  </div>
</template>
