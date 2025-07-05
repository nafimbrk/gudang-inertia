<script setup>
import Main from "../../Layouts/Main.vue";
import { Head, router, useForm, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import Pagination from "../../Layouts/Partials/Pagination.vue";
import { computed, onMounted, ref, watch } from "vue";

const props = defineProps({
    warehouses: Object,
    filters: Object,
});

const form = useForm({});

const flash = computed(() => usePage().props.flash);
const show = ref(true);

const deleteWarehouse = (id) => {
    if (confirm("Yakin ingin menghapus data?")) {
        form.delete(route("warehouse.destroy", id), {
            preserveScroll: true,
            onSuccess: () => {
                show.value = true;
            },
        });
    }
};

let search = ref(props.filters.search);

const handleSearch = () => {
    router.get(route("warehouse.index"), { search: search.value });
};

const page = usePage()

const user = computed(() => page.props.auth.user)
</script>

<template>
    <Head title="Warehouse List" />
    <Main>
        <div class="flex items-center justify-between mb-10">
            <h1 class="font-bold text-2xl">Daftar Warehouse</h1>
            <div class="flex items-center gap-2">
                <form @submit.prevent="handleSearch" class="flex items-center">
                    <div class="relative w-full">
                        <input
                            type="text"
                            v-model="search"
                            id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search Supplier..."
                        />
                    </div>
                    <button
                        type="submit"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        <svg
                            class="w-4 h-4"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 20 20"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                            />
                        </svg>
                    </button>
                </form>

                <!-- Tombol Tambah -->
                <Link
                v-if="user.role_id === 1"
                    :href="route('warehouse.create')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                >
                    <i class="fa-solid fa-plus"></i> Tambah
                </Link>
            </div>
        </div>

        <div
            v-if="flash.success && show"
            id="alert-3"
            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert"
        >
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ flash.success }}
            </div>
            <button
                type="button"
                @click="show = !show"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3"
                aria-label="Close"
            >
                <span class="sr-only">Close</span>
                <svg
                    class="w-3 h-3"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 14 14"
                >
                    <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                    />
                </svg>
            </button>
        </div>

        <div class="relative overflow-x-auto">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Nama Warehouse</th>
                        <th scope="col" class="px-6 py-3">Lokasi</th>
                        <th v-if="user.role_id === 1" scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-if="warehouses.data.length">
                        <tr
                            v-for="(warehouse, index) in warehouses.data"
                            :key="warehouse.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                {{ ++index }}
                            </th>
                            <td class="px-6 py-4">
                                {{ warehouse.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ warehouse.location }}
                            </td>
                            <td v-if="user.role_id === 1" class="px-6 py-4">
                                <Link
                                    :href="route('warehouse.edit', warehouse.id)"
                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                                >
                                    <i class="fa-solid fa-pen"></i>
                                </Link>
                                <button
                                    @click="deleteWarehouse(warehouse.id)"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    <template v-else-if="search">
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        >
                            <td
                                colspan="3"
                                class="text-center px-6 py-4 text-gray-500"
                            >
                                Data tidak ditemukan untuk kata kunci "<strong
                                    >{{ search }}</strong
                                >"
                            </td>
                        </tr>
                    </template>

                    <template v-else>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        >
                            <td
                                colspan="3"
                                class="text-center px-6 py-4 text-gray-500"
                            >
                                Data masih kosong.
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end">
            <pagination class="mt-8" :elements="warehouses" />
        </div>
    </Main>
</template>
