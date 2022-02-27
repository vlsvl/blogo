<script setup>
import Wave from '@/Components/Public/Wave'
</script>

<template>
  <!--Hero-->
  <div class="pt-16 bg-gradient-to-b from-white to-blue-300">
    <div
      class="
          flex flex-col
          w-full
          justify-center
          items-center
          text-center
        "
    >
      <h1 class="my-6 text-5xl relative z-10 font-bold leading-tight">
        <slot name="title" />
      </h1>
      <p class="leading-normal z-10 text-2xl mb-8">
        <slot name="desc" />
      </p>
    </div>
  </div>
  <div class="relative hidden md:block -mt-24 lg:-mt-36 xl:-mt-48">
    <wave />
  </div>
</template>
