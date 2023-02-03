<template>
  <div>
    <div>Clicked: {{ count }} times, count is {{ evenOrOdd }}</div>
    <button class="px-2 py-1 border-2 border-gray-300" @click="increment">+</button>
    <button class="px-2 py-1 border-2 border-gray-300" @click="decrement">-</button>
    <button class="px-2 py-1 border-2 border-gray-300" @click="incrementIfOdd">Increment if odd</button>
    <button class="px-2 py-1 border-2 border-gray-300" @click="incrementAsync">Increment async</button>
  </div>
</template>

<script setup>
import {computed} from 'vue'
import {useStore} from 'vuex'

const store = useStore()

const count = computed(() => store.state.count)
const evenOrOdd = computed(() => store.getters.evenOrOdd)
const increment = () => store.dispatch('increment')
const decrement = () => store.dispatch('decrement')
const incrementIfOdd = () => store.dispatch('incrementIfOdd')
const incrementAsync = () => store.dispatch('incrementAsync')
</script>
