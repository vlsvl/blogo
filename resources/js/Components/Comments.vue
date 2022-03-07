<script setup>
import {useForm, usePage} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'
import RichTextEditor from '@/Components/RichTextEditor'
import CInputError from '@/Components/Form/InputError'
const props = defineProps({
  comments: Array,
  postId: Number,
})

const options = {
  theme: 'snow',
  boundary: document.body,
  modules: {
    toolbar: [
      ['bold', 'italic', 'underline', 'strike'],
      ['blockquote', 'code-block'],
      ['clean'],
    ],
  },
  placeholder: 'Write comment here ...',
  readOnly: false,
}

const canComment = computed(() => !!usePage().props.value.auth?.user)

const form = useForm({
  content: 'Test comment for this post',
  post_id: props.postId,
})

function postComment() {
  form.post(route('public.comment.store'), {
    errorBag: 'commentCreate',
    onSuccess: () => form.content = '',
  })
}
</script>

<template>
  <div>
    <div v-for="(comment, id) in comments" :key="id" class="bg-white py-3 max-w-5xl">
      <div class="flex items-center">
        <div>
          <div class="text-md">
            <span class="font-semibold">{{ comment.user_name }}</span>
          </div>
          <div class="text-gray-500 text-xs flex">
            <span class="inline-block">{{ comment.created_at }}</span>
            <svg
              class="inline-block ml-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
              data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="false"
            >
              <path
                d="M8 1a7 7 0 107 7 7 7 0 00-7-7zM3 8a5 5 0 011-3l.55.55A1.5 1.5 0 015 6.62v1.07a.75.75 0 00.22.53l.56.56a.75.75 0 00.53.22H7v.69a.75.75 0 00.22.53l.56.56a.75.75 0 01.22.53V13a5 5 0 01-5-5zm6.24 4.83l2-2.46a.75.75 0 00.09-.8l-.58-1.16A.76.76 0 0010 8H7v-.19a.51.51 0 01.28-.45l.38-.19a.74.74 0 01.68 0L9 7.5l.38-.7a1 1 0 00.12-.48v-.85a.78.78 0 01.21-.53l1.07-1.09a5 5 0 01-1.54 9z"
              />
            </svg>
          </div>
        </div>
      </div>
      <p class="text-gray-800 text-lg mt-2 leading-normal md:leading-relaxed" v-html="comment.content" />
      <div class="text-gray-500 text-xs flex items-center mt-3">
        <img class="mr-0.5" src="https://static-exp1.licdn.com/sc/h/d310t2g24pvdy4pt1jkedo4yb" />
        <img class="mr-0.5" src="https://static-exp1.licdn.com/sc/h/5thsbmikm6a8uov24ygwd914f" />
        <img class="mr-0.5" src="https://static-exp1.licdn.com/sc/h/7fx9nkd7mx8avdpqm5hqcbi97" />
        <span class="ml-1">47 • 26 comments</span>
      </div>
    </div>
    <div v-if="canComment" class="mt-6">
      <form @submit.prevent="postComment">
        <RichTextEditor v-model:value="form.content" :options="options" />
        <CInputError :message="form.errors.content" />
        <div class="mt-2">
          <input type="submit" class="btn btn-primary" value="Comment" />
        </div>
      </form>
    </div>
    <div v-else class="mt-6">
      <p>For create comment you need to be authorized</p>
    </div>
  </div>
</template>
