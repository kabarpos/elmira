<template>
    <Head title="Roles Management" />
    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Card>
                    <!-- Add Role Button -->
                    <div class="mb-4">
                        <PrimaryButton @click="openAddModal">Add New Role</PrimaryButton>
                    </div>

                    <!-- Roles Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="role in roles" :key="role.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ role.name }}</td>
                                    <td class="px-6 py-4">
                                        <span v-for="permission in role.permissions" :key="permission.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2 mb-2">
                                            {{ permission.name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <SecondaryButton class="mr-2" @click="editRole(role)" v-if="role.name !== 'super-admin'">Edit</SecondaryButton>
                                        <DangerButton @click="confirmRoleDeletion(role)" v-if="role.name !== 'super-admin'">Delete</DangerButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </Card>
            </div>
        </div>

        <!-- Add/Edit Role Modal -->
        <Modal :show="showModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ isEditing ? 'Edit Role' : 'Add New Role' }}
                </h2>

                <form @submit.prevent="submitForm" class="mt-6">
                    <div>
                        <InputLabel for="name" value="Role Name" />
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
                        <InputLabel value="Permissions" />
                        <div class="mt-2 grid grid-cols-2 gap-4">
                            <label v-for="permission in permissions" :key="permission.id" class="inline-flex items-center">
                                <input
                                    type="checkbox"
                                    :value="permission.name"
                                    v-model="form.permissions"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                >
                                <span class="ml-2 text-sm text-gray-600">{{ permission.name }}</span>
                            </label>
                        </div>
                        <InputError :message="form.errors.permissions" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal" class="mr-3">Cancel</SecondaryButton>
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>

        <!-- Delete Role Confirmation Modal -->
        <Modal :show="showDeleteModal" @close="closeDeleteModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Delete Role
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Are you sure you want to delete this role? This action cannot be undone.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeDeleteModal" class="mr-3">Cancel</SecondaryButton>
                    <DangerButton :disabled="form.processing" @click="deleteRole">Delete Role</DangerButton>
                </div>
            </div>
        </Modal>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
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
    roles: Array,
    permissions: Array
});

const showModal = ref(false);
const showDeleteModal = ref(false);
const isEditing = ref(false);
const selectedRole = ref(null);

const form = useForm({
    name: '',
    permissions: []
});

const openAddModal = () => {
    form.reset();
    isEditing.value = false;
    showModal.value = true;
};

const editRole = (role) => {
    selectedRole.value = role;
    form.name = role.name;
    form.permissions = role.permissions.map(permission => permission.name);
    isEditing.value = true;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    form.reset();
    selectedRole.value = null;
};

const submitForm = () => {
    if (isEditing.value) {
        form.put(route('admin.roles.update', selectedRole.value.id), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.roles.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const confirmRoleDeletion = (role) => {
    selectedRole.value = role;
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    selectedRole.value = null;
};

const deleteRole = () => {
    form.delete(route('admin.roles.destroy', selectedRole.value.id), {
        onSuccess: () => closeDeleteModal(),
    });
};
</script>
