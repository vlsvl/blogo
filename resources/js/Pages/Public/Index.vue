<script setup>
import PublicLayout from '@/Layouts/Public.vue'
import Hero from '@/Components/Public/Hero'
import Search from '@/Components/Public/Search.vue'
import PostsList from '@/Components/Public/PostsList.vue'
import Pagination from '@/Components/Public/Pagination.vue'
import { Inertia } from '@inertiajs/inertia'
import { onMounted, ref } from 'vue'

const props = defineProps({
  posts: Object,
})

const allPosts = ref(props.posts.data)

const loadMoreIntersect = ref(null)

function loadNextPage() {
  if (props.posts.next_page_url === null) {
    return
  }

  Inertia.get(props.posts.next_page_url, {}, {
    preserveState: true,
    preserveScroll: true,
    only: ['posts'],
    onSuccess: () => {
      allPosts.value = [...allPosts.value, ...props.posts.data]
      window.history.replaceState({},'', '/')
    },
  })
}

onMounted(() => {
  const observer = new IntersectionObserver(entries => entries.forEach(entry => entry.isIntersecting && loadNextPage(), {
    rootMargin: '-150px 0px 0px 0px',
  }))

  observer.observe(loadMoreIntersect.value)
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
        <Search />
        <PostsList :posts="allPosts" />
        <span ref="loadMoreIntersect" />
        <div class="mt-8 flex justify-center">
          <Pagination :links="posts.links" />
        </div>
      </div>
    </div>
  </public-layout>
</template>
