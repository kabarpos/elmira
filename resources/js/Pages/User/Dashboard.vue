<template>
    <Head title="Dashboard" />
    <UserLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Card>
                    <div class="p-6 text-gray-900">
                        Welcome to your dashboard!
                    </div>
                </Card>
            </div>
        </div>
    </UserLayout>
</template>

<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import Card from '@/Components/Common/Card.vue';
import { Head } from '@inertiajs/vue3';
</script>
