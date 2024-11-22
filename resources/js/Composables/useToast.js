import { ref } from 'vue'

export function useToast() {
    const show = ref(false)
    const type = ref('success')
    const title = ref('')
    const message = ref('')
    let timeout

    const showToast = ({ type: toastType = 'success', title: toastTitle, message: toastMessage = '', duration = 3000 }) => {
        clearTimeout(timeout)
        
        type.value = toastType
        title.value = toastTitle || (toastType === 'success' ? 'Success' : 'Error')
        
        // Handle message if it's an object
        if (typeof toastMessage === 'object') {
            message.value = Object.values(toastMessage)[0] || ''
        } else {
            message.value = toastMessage
        }
        
        show.value = true

        timeout = setTimeout(() => {
            show.value = false
        }, duration)
    }

    const hideToast = () => {
        show.value = false
        clearTimeout(timeout)
    }

    return {
        show,
        type,
        title,
        message,
        showToast,
        hideToast
    }
}
