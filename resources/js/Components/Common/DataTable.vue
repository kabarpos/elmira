&lt;template>
  &lt;div class="overflow-x-auto">
    &lt;table class="min-w-full bg-white border border-gray-300">
      &lt;thead class="bg-gray-100">
        &lt;tr>
          &lt;th v-for="column in columns" :key="column.key" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            {{ column.label }}
          &lt;/th>
          &lt;th v-if="actions" class="px-6 py-3 text-right">Actions&lt;/th>
        &lt;/tr>
      &lt;/thead>
      &lt;tbody class="divide-y divide-gray-200">
        &lt;tr v-for="(item, index) in items" :key="index">
          &lt;td v-for="column in columns" :key="column.key" class="px-6 py-4 whitespace-nowrap">
            {{ item[column.key] }}
          &lt;/td>
          &lt;td v-if="actions" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            &lt;slot name="actions" :item="item">&lt;/slot>
          &lt;/td>
        &lt;/tr>
      &lt;/tbody>
    &lt;/table>
  &lt;/div>
&lt;/template>

&lt;script setup>
defineProps({
  columns: {
    type: Array,
    required: true
  },
  items: {
    type: Array,
    required: true
  },
  actions: {
    type: Boolean,
    default: false
  }
})
&lt;/script>
