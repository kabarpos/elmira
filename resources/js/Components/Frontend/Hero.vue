<template>
    <div class="relative h-screen">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img 
                :src="backgroundImage" 
                class="w-full h-full object-cover"
                alt="Luxury Real Estate"
            >
            <div class="absolute inset-0 bg-black/40 mix-blend-multiply"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex flex-col justify-center items-start h-full pt-20 pb-32">
                <h1 
                    class="text-4xl md:text-5xl lg:text-6xl font-bold text-white max-w-3xl"
                    v-html="title"
                ></h1>
                
                <p 
                    class="mt-6 max-w-2xl text-xl text-gray-200"
                    v-html="subtitle"
                ></p>

                <Link
                    :href="ctaLink"
                    class="mt-8 px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white text-lg font-semibold rounded-lg transition-colors duration-200 transform hover:scale-105"
                >
                    {{ ctaText }}
                </Link>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="animate-bounce">
                <svg 
                    class="w-6 h-6 text-white"
                    xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                >
                    <path 
                        stroke-linecap="round" 
                        stroke-linejoin="round" 
                        stroke-width="2" 
                        d="M19 14l-7 7m0 0l-7-7m7 7V3"
                    />
                </svg>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    title: {
        type: String,
        required: true
    },
    subtitle: {
        type: String,
        required: true
    },
    ctaText: {
        type: String,
        required: true
    },
    ctaLink: {
        type: String,
        required: true
    },
    backgroundImage: {
        type: String,
        required: true
    }
});
</script>
