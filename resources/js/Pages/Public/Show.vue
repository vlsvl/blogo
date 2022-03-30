<script setup>
import PublicLayout from '@/Layouts/Public.vue'
import Comments from '@/Components/Comments.vue'
import {useForm} from '@inertiajs/inertia-vue3'
import {ref} from 'vue'

defineProps({
  post: Object,
  comments: Array,
})

const form = useForm({
  email: '',
})

const subscribed = ref(false)

function submit() {
  form.post(route('subscribe'), {
    onSuccess: () => subscribed.value = true,
  })
}
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
        <div class="mb-12">
          <div class="text-2xl text-gray-500">Comments</div>
          <Comments :comments="comments" :post-id="post.id" />
        </div>
        <div class="flex flex-col md:h-56 bg-white rounded-lg shadow-lg overflow-hidden md:flex-row my-10">
          <div class="md:flex items-center justify-center md:w-1/2 md:bg-main-darkBlue">
            <div class="py-6 px-8 md:py-0">
              <h2 class="text-gray-700 text-2xl font-bold md:text-gray-100">Sign Up For News Updates</h2>
              <p class="mt-2 text-gray-600 md:text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consectetur obcaecati odio</p>
            </div>
          </div>
          <div class="flex items-center justify-center pb-6 md:py-0 md:w-1/2 md:border-b-8 border-main-darkBlue">
            <form v-if="!subscribed" @submit.prevent="submit">
              <div class="flex flex-col rounded-lg overflow-hidden sm:flex-row">
                <input v-model="form.email" class="py-3 px-4 bg-main-blue-200 text-white border-gray-300 border-2 outline-none placeholder-gray-500 focus:bg-gray-100" type="text" name="email" placeholder="Enter your email" />
                <button class="py-3 px-4 bg-main-darkBlue text-white font-semibold uppercase hover:bg-main-blue">subscribe</button>
              </div>
            </form>
            <h3 v-else class="text-2xl">You subscribed</h3>
          </div>
        </div>
      </div>
    </div>
  </public-layout>
</template>
