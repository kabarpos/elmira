<template>
    <Head title="Admin Dashboard" />
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Card title="Total Users">
                        <div class="text-3xl font-bold">{{ stats.total_users }}</div>
                    </Card>
                    
                    <Card title="Administrators">
                        <div class="text-3xl font-bold">{{ stats.total_admins }}</div>
                    </Card>
                    
                    <Card title="Editors">
                        <div class="text-3xl font-bold">{{ stats.total_editors }}</div>
                    </Card>
                    
                    <Card title="Basic Users">
                        <div class="text-3xl font-bold">{{ stats.total_users_basic }}</div>
                    </Card>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <Card title="Quick Links">
                        <div class="space-y-4">
                            <Link v-if="$page.props.auth.user.roles.includes('super-admin')" 
                                  :href="route('admin.users.index')"
                                  class="block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                Manage Users
                            </Link>
                            <Link v-if="$page.props.auth.user.roles.includes('super-admin')"
                                  :href="route('admin.roles.index')"
                                  class="block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                Manage Roles
                            </Link>
                        </div>
                    </Card>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from '@/Components/Common/Card.vue';

defineProps({
    stats: {
        type: Object,
        required: true
    }
});
</script>
