<script setup>
defineProps({
  headers: Array,
  rows: Array,
  actions: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <table class="items-center bg-transparent border-collapse border-b-2 border-b-gray-100">
    <thead>
      <tr>
        <th
          v-for="(head, k) in headers"
          :key="k"
          class="
            px-6
            bg-blueGray-50
            text-blueGray-500
            align-middle
            border border-solid border-gray-100
            py-3
            text-xs
            uppercase
            border-l-0 border-r-0
            whitespace-nowrap
            font-semibold
            text-left
          "
          :style="{ width: head.name === 'id' ? '1%' : 'auto' }"
        >
          {{ head.name !== "id" ? head.title : "#" }}
        </th>
        <th v-if="actions?.length !== 0" style="width: 1%" />
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(row, id) in rows"
        :key="id"
        class="hover:bg-blue-200 duration-200"
        :class="{ 'bg-gray-100': id % 2 === 0 }"
      >
        <td
          v-for="(header, hid) in headers"
          :key="row.id + hid"
          class="
            border-t-0
            px-6
            align-middle
            border-l-0 border-r-0
            text-sm
            whitespace-nowrap
            p-2
            text-left
          "
        >
          {{ row[header.name] }}
        </td>
      </tr>
    </tbody>
  </table>
</template>
