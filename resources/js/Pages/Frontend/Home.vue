<template>
    <Head>
        <title>{{ siteSettings.site_name }} - Luxury Real Estate</title>
        <meta name="description" content="Discover luxury homes and premium real estate properties">
    </Head>

    <FrontendLayout>
        <Navbar 
            :site-name="siteSettings.site_name"
            :logo="siteSettings.logo_path"
        />

        <Hero
            :title="siteSettings.hero_title"
            :subtitle="siteSettings.hero_subtitle"
            :cta-text="siteSettings.hero_cta_text"
            :cta-link="siteSettings.hero_cta_link"
            :background-image="siteSettings.hero_background_image"
        />
    </FrontendLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';
import Navbar from '@/Components/Frontend/Navbar.vue';
import Hero from '@/Components/Frontend/Hero.vue';

defineProps({
    siteSettings: {
        type: Object,
        required: true
    }
});
</script>
