&lt;template>
  &lt;div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    &lt;div v-if="title" class="px-6 py-4 border-b border-gray-200">
      &lt;h3 class="text-lg font-medium text-gray-900">
        {{ title }}
      &lt;/h3>
    &lt;/div>
    &lt;div class="p-6">
      &lt;slot>&lt;/slot>
    &lt;/div>
  &lt;/div>
&lt;/template>

&lt;script setup>
defineProps({
  title: {
    type: String,
    default: ''
  }
})
&lt;/script>
