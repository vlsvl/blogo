<script setup>
import PublicLayout from '@/Layouts/Public.vue'
import Comments from '@/Components/Comments.vue'

defineProps({
  post: Object,
  comments: Array,
})
</script>

<template>
  <public-layout title="Welcome">
    <div class="container mx-auto py-16 px-4 max-w-5xl">
      <div class="border-t-8 border-blue-100 pt-6">
        <h1 class="text-3xl text-gray-600 mb-8">{{ post.title }}</h1>
        <div class="flex justify-between pb-6">
          <span class="text-sm block text-cyan-600">{{ post.user.name }}</span>
          <span class="text-sm block text-gray-600">{{ post.posted_at }}</span>
        </div>
        <div class="mb-6" v-html="post.content" />
        <div>
          <div class="text-2xl text-gray-500">Comments</div>
          <Comments :comments="comments" :post-id="post.id" />
        </div>
      </div>
    </div>
  </public-layout>
</template>
