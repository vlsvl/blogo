<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
  posts: Array,
})
</script>

<template>
  <div class="flex flex-col">
    <div v-for="(post, id) in posts" :key="id" class="pb-4 mb-16 border-b-2 border-main-blue">
      <Link class="text-gray-600 hover:underline hover:text-main-blue" :href="route('public.post.show', post.slug)">
        <h2 class="text-2xl font-bold mb-4">{{ post.title }}</h2>
      </Link>
      <div class="flex justify-between pb-6">
        <span class="text-sm block text-cyan-600">{{ post.user.name }}</span>
        <span>
          <span class="text-sm inline-block text-gray-600 mr-4">{{ post.posted_at }}</span>
          <span class="text-sm inline-block text-gray-600">Comments: {{ post.comments_count || 0 }}</span>
        </span>
      </div>
      <div class="text-lg" v-html="post.content" />
    </div>
  </div>
</template>
