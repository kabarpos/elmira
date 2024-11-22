<template>
    <Head :title="pageTitle" />
    
    <AdminLayout ref="layout">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Website Settings
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">General Settings</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Manage your website's general settings and appearance.
                                    </p>
                                </div>
                            </div>

                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form @submit.prevent="submit">
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <!-- Title -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Website Title
                                                </label>
                                                <input type="text" v-model="form.title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <!-- Subtitle -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Website Subtitle
                                                </label>
                                                <input type="text" v-model="form.subtitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <!-- Logo -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Logo
                                                </label>
                                                <div class="mt-1 flex items-center space-x-4">
                                                    <!-- Current or Preview Logo -->
                                                    <div v-if="logoPreview || settings?.logo_url" class="h-12 w-auto">
                                                        <img 
                                                            :src="logoPreview || settings.logo_url" 
                                                            class="h-full w-auto object-contain"
                                                            alt="Logo Preview"
                                                        >
                                                    </div>
                                                    
                                                    <!-- Upload Input -->
                                                    <div class="flex-1">
                                                        <input 
                                                            type="file" 
                                                            ref="logoInput"
                                                            @change="handleLogoChange" 
                                                            accept="image/*" 
                                                            class="mt-1 block w-full text-sm text-gray-500
                                                                file:mr-4 file:py-2 file:px-4
                                                                file:rounded-md file:border-0
                                                                file:text-sm file:font-semibold
                                                                file:bg-indigo-50 file:text-indigo-700
                                                                hover:file:bg-indigo-100"
                                                        >
                                                    </div>

                                                    <!-- Remove Button -->
                                                    <button 
                                                        v-if="logoPreview || settings?.logo_url"
                                                        type="button"
                                                        @click="removeLogo"
                                                        class="px-3 py-2 text-sm font-medium text-red-600 hover:text-red-500"
                                                    >
                                                        Remove
                                                    </button>
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">
                                                    Upload a logo image (PNG, JPG, GIF up to 2MB)
                                                </p>
                                            </div>

                                            <!-- Address -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Address
                                                </label>
                                                <textarea v-model="form.address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                            </div>

                                            <!-- WhatsApp -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    WhatsApp Number
                                                </label>
                                                <input type="text" v-model="form.whatsapp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>

                                            <!-- Meta Ads -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">
                                                    Meta Ads / Google Ads
                                                </label>
                                                <textarea v-model="form.meta_ads" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                                            </div>
                                        </div>

                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button 
                                                type="submit" 
                                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                :disabled="form.processing"
                                            >
                                                <span v-if="form.processing">Saving...</span>
                                                <span v-else>Save Settings</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
import { ref, computed, onMounted } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    settings: Object,
    flash: Object
})

const logoPreview = ref(null)
const logoInput = ref(null)

const pageTitle = computed(() => {
    const websiteTitle = props.settings?.title || 'My Website'
    return `Website Settings - ${websiteTitle}`
})

const form = useForm({
    title: props.settings?.title ?? '',
    subtitle: props.settings?.subtitle ?? '',
    logo: null,
    address: props.settings?.address ?? '',
    whatsapp: props.settings?.whatsapp ?? '',
    meta_ads: props.settings?.meta_ads ?? ''
})

const handleLogoChange = (e) => {
    const file = e.target.files[0]
    if (file) {
        form.logo = file
        logoPreview.value = URL.createObjectURL(file)
    }
}

const removeLogo = () => {
    form.logo = null
    logoPreview.value = null
    if (logoInput.value) {
        logoInput.value.value = ''
    }
}

const submit = () => {
    form.post(route('admin.settings.update'), {
        preserveScroll: true,
        onSuccess: () => {
            if (logoPreview.value) {
                URL.revokeObjectURL(logoPreview.value)
                logoPreview.value = null
            }
        },
        onError: (errors) => {
            // layout.value.toast.showToast({
            //     type: 'error',
            //     title: 'Error',
            //     message: Object.values(errors)[0]
            // })
        }
    })
}
</script>
