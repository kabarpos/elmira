<template>
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <Link :href="route('home')" class="flex items-center">
                        <img :src="logo" :alt="siteName" class="h-12 w-auto">
                    </Link>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:space-x-8">
                    <Link 
                        v-for="item in navigation" 
                        :key="item.name"
                        :href="item.href"
                        class="text-gray-700 hover:text-primary-600 px-3 py-2 text-sm font-medium transition-colors duration-200"
                        :class="{ 'text-primary-600': item.current }"
                    >
                        {{ item.name }}
                    </Link>
                </div>

                <!-- Mobile Navigation Button -->
                <div class="flex md:hidden">
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-primary-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg 
                            class="h-6 w-6" 
                            :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }"
                            xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg 
                            class="h-6 w-6" 
                            :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }"
                            xmlns="http://www.w3.org/2000/svg" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div 
            class="md:hidden"
            :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }"
        >
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <Link
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-100 transition-colors duration-200"
                    :class="{ 'text-primary-600 bg-gray-100': item.current }"
                >
                    {{ item.name }}
                </Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    siteName: {
        type: String,
        required: true
    },
    logo: {
        type: String,
        required: true
    }
});

const mobileMenuOpen = ref(false);

const navigation = [
    { name: 'Home', href: route('home'), current: route().current('home') },
    { name: 'Properties', href: route('properties'), current: route().current('properties') },
    { name: 'About', href: route('about'), current: route().current('about') },
    { name: 'Contact', href: route('contact'), current: route().current('contact') },
];
</script>

<style scoped>
.router-link-active {
    @apply text-primary-600;
}
</style>
