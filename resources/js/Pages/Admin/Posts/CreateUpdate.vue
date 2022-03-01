<script setup>
// Import form elements
import AppLayout from '@/Layouts/Admin.vue'
// Import editor and modules
import RichTextEditor from '@/Components/RichTextEditor.vue'

defineProps({
  post: Object,
})


//   data() {
//     return {
//       quill: null,
//       content: '',
//       form: this.$inertia.form({
//         id: '' || this.post?.id,
//         title: '' || this.post?.title,
//         slug: '' || this.post?.slug,
//         content: '' || this.post?.content,
//       }),
//       modules: [
//         {
//           name: 'imageUploader',
//           module: ImageUploader,
//           options: {
//             upload: (file) => {
//               return new Promise((resolve, reject) => {
//                 const formData = new FormData()

//                 formData.append('image', file)

//                 axios.post(
//                   route('editor.upload'),
//                   {
//                     method: 'POST',
//                     body: formData,
//                   },
//                 )
//                   .then(response => response.json())
//                   .then(result => {
//                     console.log(result)
//                     resolve(result.data.url)
//                   })
//                   .catch(error => {
//                     reject('Upload failed')
//                     console.error('Error:', error)
//                   })
//               })
//             },
//           },
//         },
//       ],
//     }
//   },
//   created() {
//     if (this.post) {
//       this.content = this.post.content
//     }
//   },
//   methods: {
//     submit() {
//       this.form.content = this.content

//       if (!this.post) {
//         this.form.post(this.route('posts.store'))
//       } else {
//         this.form.put(this.route('posts.update', this.post.id))
//       }
//     },
//     onEditorReady (editor) {
//       this.editor = editor
//       console.log(editor)
//     },
//   },
// })
</script>

<template>
  <app-layout title="Posts">
    <div class="">
      <div class="">
        <RichTextEditor />
      </div>
    </div>
  </app-layout>
</template>
