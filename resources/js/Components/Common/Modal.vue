&lt;template>
  &lt;TransitionRoot appear :show="modelValue" as="template">
    &lt;Dialog as="div" @close="$emit('update:modelValue', false)" class="relative z-10">
      &lt;TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        &lt;div class="fixed inset-0 bg-black bg-opacity-25" />
      &lt;/TransitionChild>

      &lt;div class="fixed inset-0 overflow-y-auto">
        &lt;div class="flex min-h-full items-center justify-center p-4 text-center">
          &lt;TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            &lt;DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              &lt;DialogTitle
                as="h3"
                class="text-lg font-medium leading-6 text-gray-900"
              >
                {{ title }}
              &lt;/DialogTitle>
              
              &lt;div class="mt-2">
                &lt;slot>&lt;/slot>
              &lt;/div>

              &lt;div class="mt-4 flex justify-end space-x-2">
                &lt;slot name="footer">
                  &lt;button
                    type="button"
                    class="inline-flex justify-center rounded-md border border-transparent bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2"
                    @click="$emit('update:modelValue', false)"
                  >
                    Close
                  &lt;/button>
                &lt;/slot>
              &lt;/div>
            &lt;/DialogPanel>
          &lt;/TransitionChild>
        &lt;/div>
      &lt;/div>
    &lt;/Dialog>
  &lt;/TransitionRoot>
&lt;/template>

&lt;script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

defineProps({
  modelValue: {
    type: Boolean,
    required: true
  },
  title: {
    type: String,
    required: true
  }
})

defineEmits(['update:modelValue'])
&lt;/script>
