<template>
    <Head :title="pageTitle" />
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Card>
                    <!-- Add User Button -->
                    <div class="mb-4">
                        <PrimaryButton @click="openAddModal">Add New User</PrimaryButton>
                    </div>

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="user in users" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ user.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ user.email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span v-for="role in user.roles" :key="role.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                            {{ role.name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <SecondaryButton class="mr-2" @click="editUser(user)">Edit</SecondaryButton>
                                        <DangerButton @click="confirmUserDeletion(user)" v-if="!user.roles.some(role => role.name === 'super-admin')">Delete</DangerButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </Card>
            </div>
        </div>

        <!-- Add/Edit User Modal -->
        <Modal :show="showModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ isEditing ? 'Edit User' : 'Add New User' }}
                </h2>

                <form @submit.prevent="submitForm" class="mt-6">
                    <div class="mt-6">
                        <InputLabel for="name" value="Name" />
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                        />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                        />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>

                    <div class="mt-6" v-if="!isEditing">
                        <InputLabel for="password" value="Password" />
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                        />
                        <InputError :message="form.errors.password" class="mt-2" />
                    </div>

                    <div class="mt-6" v-if="!isEditing">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            required
                        />
                    </div>

                    <div class="mt-6">
                        <InputLabel value="Roles" />
                        <div class="mt-2 space-y-2">
                            <label v-for="role in roles" :key="role.id" class="inline-flex items-center mr-4">
                                <input
                                    type="checkbox"
                                    :value="role.name"
                                    v-model="form.roles"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                >
                                <span class="ml-2 text-sm text-gray-600">{{ role.name }}</span>
                            </label>
                        </div>
                        <InputError :message="form.errors.roles" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal" class="mr-3">Cancel</SecondaryButton>
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- Delete User Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="closeDeleteModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Delete User
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Are you sure you want to delete this user? This action cannot be undone.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeDeleteModal" class="mr-3">Cancel</SecondaryButton>
                    <DangerButton :disabled="form.processing" @click="deleteUser">Delete User</DangerButton>
                </div>
            </div>
        </Modal>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Card from '@/Components/Common/Card.vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    users: Array,
    roles: Array,
    settings: Object
});

const showModal = ref(false);
const showDeleteModal = ref(false);
const isEditing = ref(false);
const selectedUser = ref(null);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    roles: []
});

const openAddModal = () => {
    form.reset();
    isEditing.value = false;
    showModal.value = true;
};

const editUser = (user) => {
    selectedUser.value = user;
    form.name = user.name;
    form.email = user.email;
    form.roles = user.roles.map(role => role.name);
    isEditing.value = true;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    form.reset();
    selectedUser.value = null;
};

const submitForm = () => {
    if (isEditing.value) {
        form.put(route('admin.users.update', selectedUser.value.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.users.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const confirmUserDeletion = (user) => {
    selectedUser.value = user;
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    selectedUser.value = null;
};

const deleteUser = () => {
    form.delete(route('admin.users.destroy', selectedUser.value.id), {
        onSuccess: () => closeDeleteModal(),
    });
};

const pageTitle = computed(() => {
    const websiteTitle = props.settings?.title || 'My Website'
    return `Users - ${websiteTitle}`
})
</script>
