<script setup>
// Import form elements
import AppLayout from '@/Layouts/Admin.vue'
import {useForm, usePage, Link} from '@inertiajs/inertia-vue3'
import FormSection from '@/Components/Form/FormSection.vue'
import CLabel from '@/Components/Form/Label.vue'
import CInput from '@/Components/Form/Input.vue'
import CInputError from '@/Components/Form/InputError.vue'
import CCheckbox from '@/Components/Form/Checkbox.vue'
import ActionMessage from '@/Components/Form/ActionMessage.vue'
import VueMultiselect from 'vue-multiselect'
import {ref} from 'vue'
// Import editor and modules
import RichTextEditor from '@/Components/RichTextEditor.vue'

const props = defineProps({
  post: Object,
})

console.log('Post', props.post)
// Wysiwyg options
const options = {
  modules: {
    toolbar: {
      container: [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        [{ script: 'sub' }, { script: 'super' }],
        [{ indent: '-1' }, { indent: '+1' }],
        [{ direction: 'rtl' }],
        [{ size: ['small', false, 'large', 'huge'] }],
        [{ header: [2, 3, 4, 5, 6, false] }],
        [{ color: [] }, { background: [] }],
        [{ font: [] }],
        [{ align: [] }],
        ['clean'],
        [{cut: 'Cut' }],
        ['link', 'image'],
      ],
      handlers: {
        // Handler for upload image to server (default quill paste it in base64)
        image() {
          const file = document.createElement('input')
          file.setAttribute('type', 'file')
          file.setAttribute('accept', 'image/*')
          file.addEventListener('change', (e) => {
            const form = new FormData()
            form.append('file', file.files[0])
            axios.post(route('uploadImage', usePage().props.value.post?.slug), form)
              .then(response => {
                const result = response.data
                console.log(result)
                const range = this.quill.getSelection()
                this.quill.insertEmbed(range.index, 'image', result.link)
              })
          })
          file.click()
        },
      },
    },
  },
}

const form = useForm({
  id: '' || props.post?.id,
  title: '' || props.post?.title,
  slug: '' || props.post?.slug,
  content: '' || props.post?.content,
  published: Boolean(props.post?.posted_at),
  user_id: usePage().props.value.auth.user.id || '',
  tags: [],
})

function savePost() {
  form.tags = selectedTags.value
  form[props.post ? 'patch' : 'post'](
    props.post ? route('posts.update', props.post.slug) : route('posts.store'),
    {
      errorBag: 'createUpdatePost',
      preserveScroll: true,
      onSuccess: () => console.log('Post success'),
      onError: () => {
        console.error(form.errors)
      },
    },
  )
}

// Multiselect options
const tags = ref([
  { name: 'Vue.js', id: 1 },
  { name: 'Rails', id: 2 },
  { name: 'Sinatra', id: 3 },
  { name: 'Laravel', id: 4 },
  { name: 'Phoenix', id: 5 },
])
const selectedTags = ref(props.post?.tags || [])
function addTag(newTag) {
  const tag = {
    name: newTag,
    id: newTag + '_' + Math.random() * 10000000,
  }
  selectedTags.value.push(tag)
  tags.value.push(tag)
}
function asyncFind() {
  tags.value = ['test1', 'test2', 'test3', 'after find']
}

</script>

<template>
  <app-layout title="Posts">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Post: {{ post ? post.title : 'Create post' }}
      </h2>
    </template>
    <FormSection @submitted="savePost">
      <template #title>
        {{ post ? 'Update' : 'Create' }} Post
      </template>

      <template #description>
        <div class="mb-4">
          Edit content of your post.
        </div>
        <Link :href="route('posts.index')" class="btn btn-primary">Back to list</Link>
      </template>

      <template #form>
        <div class="col-span-6 sm:col-span-4">
          <CLabel for="title" value="Post title" />
          <CInput id="title" ref="titleInput" v-model="form.title" type="text" class="mt-1 block w-full" />
          <CInputError :message="form.errors.title" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
          <CLabel for="slug" value="Post slug" />
          <CInput id="slug" ref="slugInput" v-model="form.slug" type="text" class="mt-1 block w-full" />
          <CInputError :message="form.errors.slug" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
          <CCheckbox v-model:checked="form.published" name="remember" />
          <span class="ml-2 text-sm text-gray-600">Post published</span>
        </div>

        <div class="col-span-6 sm:col-span-4">
          <CLabel value="Post content" />
          <RichTextEditor v-model:value="form.content" :content="form.content" :options="options" />
          <CInputError :message="form.errors.content" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
          <CLabel value="Post tags" />
          <VueMultiselect
            v-model="selectedTags"
            :options="tags"
            :multiple="true"
            :searchable="true"
            placeholder="Type to search"
            :hide-selected="true"
            :close-on-select="false"
            :taggable="true"
            label="name"
            track-by="id"
            @tag="addTag"
          >
            <span>
              Oops! No elements found. Consider changing the search query.
            </span>
          </VueMultiselect>
          <CInputError :message="form.errors.content" class="mt-2" />
        </div>
      </template>

      <template #actions>
        <ActionMessage :on="form.recentlySuccessful" class="mr-3">
          Saved.
        </ActionMessage>

        <input
          type="submit" class="btn btn-primary"
          :class="{ 'opacity-25': form.processing }" :disabled="form.processing || form.content === ''"
          :value="post ? 'Update' : 'Save'"
        />
      </template>
    </FormSection>
  </app-layout>
</template>
