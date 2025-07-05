<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import Main from "../../Layouts/Main.vue";

const props = defineProps({
    supplier: Object,
});

const form = useForm({
    name: props.supplier.name,
    contact_info: props.supplier.contact_info,
});

const updateSupplier = () =>
    form.put(route("supplier.update", props.supplier.id));
</script>

<template>
    <Head title="Supplier Edit" />
    <Main>
        <h1 class="font-bold text-2xl">Edit Supplier</h1>
        <form @submit.prevent="updateSupplier" class="mt-10">
            <div class="mb-5">
                <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Nama Kategori</label
                >
                <p v-if="form.errors.name" class="text-red-500 italic">
                    {{ form.errors.name }}
                </p>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
            </div>
            <div class="mb-5">
                <label
                    for="contact_info"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Kontak</label
                >
                <p v-if="form.errors.contact_info" class="text-red-500 italic">
                    {{ form.errors.contact_info }}
                </p>
                <input
                    type="number"
                    id="contact_info"
                    v-model="form.contact_info"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
            </div>
            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
                Submit
            </button>
        </form>
    </Main>
</template>
