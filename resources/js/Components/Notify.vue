<template>
  <div v-show="elementVisible" id="notify" class="absolute top-2 right-2 ml-auto mr-3 flex flex-col gap-2 w-72 border-b-4 shadow-lg z-50">
    <div class="bg-white rounded-t text-gray-900 px-4 py-3" role="alert">
      <div class="flex">
        <div>
          <svg class="fill-current h-6 w-6 text--500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" /></svg>
        </div>
        <div>
          <p class="text-sm text-gray-900">{{ message }}</p>
        </div>
        <p class="flex cursor-pointer">
          <svg class="text-blue-500 text-xl" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
            <path d="M685.4 354.8c0-4.4-3.6-8-8-8l-66 .3L512 465.6l-99.3-118.4-66.1-.3c-4.4 0-8 3.5-8 8 0 1.9.7 3.7 1.9 5.2l130.1 155L340.5 670a8.32 8.32 0 0 0-1.9 5.2c0 4.4 3.6 8 8 8l66.1-.3L512 564.4l99.3 118.4 66 .3c4.4 0 8-3.5 8-8 0-1.9-.7-3.7-1.9-5.2L553.5 515l130.1-155c1.2-1.4 1.8-3.3 1.8-5.2z" />
            <path d="M512 65C264.6 65 64 265.6 64 513s200.6 448 448 448 448-200.6 448-448S759.4 65 512 65zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z" />
          </svg>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useStore } from 'vuex'
import { onMounted, ref } from 'vue'
const elementVisible = ref(false)
const message = ref('Test')

onMounted(() => {
  window.Echo.channel('BLogo.Public')
    .error((error) => {
      console.error(`My Received error: ${JSON.stringify(error)}`)
    })
    .listen('.console.message', data => {
      // console.log('Log event: ', data.message)
      message.value = data.message
      delay()
    })
})

const delay = () => {
  elementVisible.value = true
  setTimeout(() => (elementVisible.value = false), 5000)
}
</script>
