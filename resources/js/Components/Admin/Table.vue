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
  <table class="flex lg:table items-center bg-transparent border-collapse border-b-2 border-b-gray-100">
    <thead class="hidden lg:table-header-group">
      <tr class="table-row">
        <th
          v-for="(head, k) in headers"
          :key="k"
          class="
            table-cell
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
    <tbody class="block w-full lg:table-row-group">
      <tr
        v-for="(row, id) in rows"
        :key="id"
        class="block shadow-xl mb-6 p-4 lg:p-0 border-2 border-gray-200 lg:border-0 lg:mb-0 lg:shadow-none lg:table-row hover:bg-blue-200 duration-200"
        :class="{ 'bg-gray-100': id % 2 === 0 }"
      >
        <td
          v-for="(header, hid) in headers"
          :key="row.id + hid"
          class="
            block
            lg:table-cell
            border-t-0
            px-6
            align-middle
            border-l-0 border-r-0
            text-sm
            whitespace-break
            p-2
            text-left
          "
        >
          <span class="inline-block lg:hidden text-gray-600 underline">{{ header.name }}:</span>
          <span class="break-words">
            {{ row[header.name] }}
          </span>
        </td>
      </tr>
    </tbody>
  </table>
</template>
