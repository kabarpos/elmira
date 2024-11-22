<template>
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Site Settings
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="space-y-8">
                            <!-- Success Message -->
                            <div v-if="$page.props.flash.success" class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-green-700">{{ $page.props.flash.success }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Navbar Settings -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Navbar Settings</h3>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-4">
                                        <InputLabel for="site_name" value="Site Name" />
                                        <TextInput
                                            id="site_name"
                                            v-model="form.site_name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            required
                                        />
                                        <InputError :message="form.errors.site_name" class="mt-2" />
                                    </div>

                                    <div class="sm:col-span-6">
                                        <InputLabel for="logo" value="Logo" />
                                        <div class="mt-1 flex items-center space-x-4">
                                            <img 
                                                v-if="settings.logo_path" 
                                                :src="'/storage/' + settings.logo_path" 
                                                class="h-12 w-auto"
                                                alt="Current Logo"
                                            >
                                            <FileInput
                                                id="logo"
                                                @input="form.logo = $event.target.files[0]"
                                                type="file"
                                                class="mt-1 block w-full"
                                                accept="image/*"
                                            />
                                        </div>
                                        <InputError :message="form.errors.logo" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Hero Settings -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Hero Section Settings</h3>
                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <InputLabel for="hero_background" value="Background Image" />
                                        <div class="mt-1 flex items-center space-x-4">
                                            <img 
                                                v-if="settings.hero_background_image" 
                                                :src="'/storage/' + settings.hero_background_image" 
                                                class="h-32 w-auto object-cover"
                                                alt="Current Background"
                                            >
                                            <FileInput
                                                id="hero_background"
                                                @input="form.hero_background = $event.target.files[0]"
                                                type="file"
                                                class="mt-1 block w-full"
                                                accept="image/*"
                                            />
                                        </div>
                                        <InputError :message="form.errors.hero_background" class="mt-2" />
                                    </div>

                                    <div class="sm:col-span-4">
                                        <InputLabel for="hero_title" value="Hero Title" />
                                        <TextInput
                                            id="hero_title"
                                            v-model="form.hero_title"
                                            type="text"
                                            class="mt-1 block w-full"
                                            required
                                        />
                                        <InputError :message="form.errors.hero_title" class="mt-2" />
                                    </div>

                                    <div class="sm:col-span-6">
                                        <InputLabel for="hero_subtitle" value="Hero Subtitle" />
                                        <TextArea
                                            id="hero_subtitle"
                                            v-model="form.hero_subtitle"
                                            class="mt-1 block w-full"
                                            rows="3"
                                            required
                                        />
                                        <InputError :message="form.errors.hero_subtitle" class="mt-2" />
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel for="hero_cta_text" value="CTA Button Text" />
                                        <TextInput
                                            id="hero_cta_text"
                                            v-model="form.hero_cta_text"
                                            type="text"
                                            class="mt-1 block w-full"
                                            required
                                        />
                                        <InputError :message="form.errors.hero_cta_text" class="mt-2" />
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel for="hero_cta_link" value="CTA Button Link" />
                                        <TextInput
                                            id="hero_cta_link"
                                            v-model="form.hero_cta_link"
                                            type="text"
                                            class="mt-1 block w-full"
                                            required
                                        />
                                        <InputError :message="form.errors.hero_cta_link" class="mt-2" />
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel for="hero_overlay_color" value="Overlay Color" />
                                        <TextInput
                                            id="hero_overlay_color"
                                            v-model="form.hero_overlay_color"
                                            type="text"
                                            class="mt-1 block w-full"
                                            required
                                        />
                                        <InputError :message="form.errors.hero_overlay_color" class="mt-2" />
                                    </div>

                                    <div class="sm:col-span-3">
                                        <InputLabel for="hero_overlay_opacity" value="Overlay Opacity (%)" />
                                        <TextInput
                                            id="hero_overlay_opacity"
                                            v-model="form.hero_overlay_opacity"
                                            type="number"
                                            min="0"
                                            max="100"
                                            class="mt-1 block w-full"
                                            required
                                        />
                                        <InputError :message="form.errors.hero_overlay_opacity" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save Changes
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    settings: {
        type: Object,
        required: true
    }
});

const form = useForm({
    site_name: props.settings.site_name,
    logo: null,
    hero_title: props.settings.hero_title,
    hero_subtitle: props.settings.hero_subtitle,
    hero_cta_text: props.settings.hero_cta_text,
    hero_cta_link: props.settings.hero_cta_link,
    hero_background: null,
    hero_overlay_color: props.settings.hero_overlay_color,
    hero_overlay_opacity: props.settings.hero_overlay_opacity,
});

const submit = () => {
    form.post(route('admin.settings.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('logo', 'hero_background');
        },
    });
};
</script>
