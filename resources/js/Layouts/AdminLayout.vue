<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <AdminNavigation 
                :user="$page.props.auth.user"
                :showing-navigation-dropdown="showingNavigationDropdown"
                @toggle-navigation="showingNavigationDropdown = !showingNavigationDropdown"
                @logout="logout"
            />

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import AdminNavigation from '@/Components/Navigation/AdminNavigation.vue';
import { router } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};
</script>
