<template>
    <Transition
        enter-active-class="transform ease-out duration-300 transition"
        enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div v-show="show" class="fixed top-4 right-4 z-50 pointer-events-auto">
            <div class="min-w-[320px] max-w-md w-full bg-white shadow-lg rounded-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <CheckCircleIcon v-if="type === 'success'" class="h-6 w-6 text-green-400" />
                            <ExclamationCircleIcon v-else class="h-6 w-6 text-red-400" />
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900">{{ title }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ message }}</p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button
                                type="button"
                                class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                @click="handleClose"
                            >
                                <span class="sr-only">Close</span>
                                <XMarkIcon class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'
import { CheckCircleIcon, ExclamationCircleIcon, XMarkIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    type: {
        type: String,
        default: 'success'
    },
    title: {
        type: String,
        required: true
    },
    message: {
        type: [String, Object],
        default: ''
    },
    duration: {
        type: Number,
        default: 3000
    }
})

const emit = defineEmits(['close'])

let timeout

const handleClose = () => {
    emit('close')
}

onMounted(() => {
    if (props.duration > 0) {
        timeout = setTimeout(() => {
            handleClose()
        }, props.duration)
    }
})

onUnmounted(() => {
    if (timeout) clearTimeout(timeout)
})
</script>
