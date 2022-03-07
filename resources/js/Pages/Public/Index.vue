<script setup>
import PublicLayout from '@/Layouts/Public.vue'
import Hero from '@/Components/Public/Hero'
import PostsList from '@/Components/Public/PostsList.vue'
import Pagination from '@/Components/Public/Pagination.vue'

defineProps({
  posts: Object,
})
</script>

<template>
  <public-layout title="Welcome">
    <hero>
      <template #title>
        Hello from hero block!
      </template>
      <template #desc>
        And some words after hello!
      </template>
    </hero>
    <div
      class="
      mt-24
      relative
      flex
      items-top
      justify-center
      min-h-screen
      sm:items-center px-4
    "
    >
      <div class="container mx-auto max-w-5xl">
        <PostsList :posts="posts.data" />
        <div class="mt-8 flex justify-center">
          <Pagination :links="posts.links" />
        </div>
      </div>
    </div>
  </public-layout>
</template>
