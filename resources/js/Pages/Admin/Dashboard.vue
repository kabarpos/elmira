&lt;template>
    &lt;AdminLayout>
        &lt;template #header>
            &lt;h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Admin Dashboard
            &lt;/h2>
        &lt;/template>

        &lt;div class="py-12">
            &lt;div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                &lt;div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    &lt;Card title="Total Users">
                        &lt;div class="text-3xl font-bold">{{ stats.total_users }}&lt;/div>
                    &lt;/Card>
                    
                    &lt;Card title="Administrators">
                        &lt;div class="text-3xl font-bold">{{ stats.total_admins }}&lt;/div>
                    &lt;/Card>
                    
                    &lt;Card title="Editors">
                        &lt;div class="text-3xl font-bold">{{ stats.total_editors }}&lt;/div>
                    &lt;/Card>
                    
                    &lt;Card title="Basic Users">
                        &lt;div class="text-3xl font-bold">{{ stats.total_users_basic }}&lt;/div>
                    &lt;/Card>
                &lt;/div>
            &lt;/div>
        &lt;/div>
    &lt;/AdminLayout>
&lt;/template>

&lt;script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from '@/Components/Common/Card.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    stats: {
        type: Object,
        required: true
    }
});
&lt;/script>
