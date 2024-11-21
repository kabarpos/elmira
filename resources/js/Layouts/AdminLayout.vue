&lt;template>
    &lt;div>
        &lt;div class="min-h-screen bg-gray-100">
            &lt;nav class="bg-white border-b border-gray-100">
                &lt;div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    &lt;div class="flex justify-between h-16">
                        &lt;div class="flex">
                            &lt;!-- Logo -->
                            &lt;div class="shrink-0 flex items-center">
                                &lt;Link :href="route('admin.dashboard')">
                                    &lt;ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                &lt;/Link>
                            &lt;/div>

                            &lt;!-- Navigation Links -->
                            &lt;div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                &lt;NavLink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
                                    Dashboard
                                &lt;/NavLink>
                                
                                &lt;template v-if="$page.props.auth.user.roles.includes('super-admin')">
                                    &lt;NavLink :href="route('admin.users.index')" :active="route().current('admin.users.*')">
                                        Users
                                    &lt;/NavLink>
                                    &lt;NavLink :href="route('admin.roles.index')" :active="route().current('admin.roles.*')">
                                        Roles
                                    &lt;/NavLink>
                                &lt;/template>
                                
                                &lt;NavLink :href="route('admin.posts.index')" :active="route().current('admin.posts.*')">
                                    Posts
                                &lt;/NavLink>
                                
                                &lt;NavLink :href="route('admin.media.index')" :active="route().current('admin.media.*')">
                                    Media
                                &lt;/NavLink>
                            &lt;/div>
                        &lt;/div>

                        &lt;div class="hidden sm:flex sm:items-center sm:ml-6">
                            &lt;div class="ml-3 relative">
                                &lt;Dropdown align="right" width="48">
                                    &lt;template #trigger>
                                        &lt;span class="inline-flex rounded-md">
                                            &lt;button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}
                                                &lt;svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    &lt;path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                &lt;/svg>
                                            &lt;/button>
                                        &lt;/span>
                                    &lt;/template>

                                    &lt;template #content>
                                        &lt;DropdownLink :href="route('profile.edit')">Profile&lt;/DropdownLink>
                                        &lt;DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        &lt;/DropdownLink>
                                    &lt;/template>
                                &lt;/Dropdown>
                            &lt;/div>
                        &lt;/div>
                    &lt;/div>
                &lt;/div>
            &lt;/nav>

            &lt;!-- Page Heading -->
            &lt;header class="bg-white shadow" v-if="$slots.header">
                &lt;div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    &lt;slot name="header" />
                &lt;/div>
            &lt;/header>

            &lt;!-- Page Content -->
            &lt;main>
                &lt;slot />
            &lt;/main>
        &lt;/div>
    &lt;/div>
&lt;/template>

&lt;script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
&lt;/script>
