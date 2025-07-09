<script setup>
import { ref } from "vue";
import { useForm, Head, usePage } from "@inertiajs/vue3";
import Main from "../../Layouts/Main.vue";
import { route } from "ziggy-js";
import VueSelect from "vue3-select";
import "vue3-select/dist/vue3-select.css";

const props = defineProps({
    item: Object,
    category: Array,
    supplier: Array,
    warehouse: Array,
    unit: Array
});

const showCategoryModal = ref(false); // state modal
const showSupplierModal = ref(false); // state modal
const showWarehouseModal = ref(false); // state modal
const showUnitModal = ref(false); // state modal

const findById = (list, id) => list.find((item) => item.id === id) || null;

const form = useForm({
    name: props.item.name || "",
    category_id: findById(props.category, props.item.category_id),
    supplier_id: findById(props.supplier, props.item.supplier_id),
    warehouse_id: findById(props.warehouse, props.item.warehouse_id),
    stock: props.item.stock || "",
    unit_id: findById(props.unit, props.item.unit_id),
});


const updateItem = () => {
    form.put(route("item.update", props.item.id));
};


// Form untuk tambah kategori dari modal
const categoryForm = useForm({
    name: ""
});
const supplierForm = useForm({
    name: ""
});
const warehouseForm = useForm({
    name: ""
});
const unitForm = useForm({
    name: ""
});

const page = usePage();

const categoryOptions = ref([...props.category]);
const supplierOptions = ref([...props.supplier]);
const warehouseOptions = ref([...props.warehouse]);
const unitOptions = ref([...props.unit]);

const storeCategory = () => {
    categoryForm.post(route("item.category.store"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            const newCategory = page.props.flash.new_category;

            if (newCategory) {
                categoryOptions.value.push(newCategory);
                form.category_id = newCategory;
            }

            categoryForm.reset();
            showCategoryModal.value = false;
        },
    });
};
const storeSupplier = () => {
    supplierForm.post(route("item.supplier.store"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            const newSupplier = page.props.flash.new_supplier;

            if (newSupplier) {
                supplierOptions.value.push(newSupplier);
                form.supplier_id = newSupplier;
            }

            supplierForm.reset();
            showSupplierModal.value = false;
        },
    });
};
const storeWarehouse = () => {
    warehouseForm.post(route("item.warehouse.store"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            const newWarehouse = page.props.flash.new_warehouse;

            if (newWarehouse) {
                warehouseOptions.value.push(newWarehouse);
                form.warehouse_id = newWarehouse;
            }

            warehouseForm.reset();
            showWarehouseModal.value = false;
        },
    });
};
const storeUnit = () => {
    unitForm.post(route("item.unit.store"), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            const newUnit = page.props.flash.new_unit;

            if (newUnit) {
                unitOptions.value.push(newUnit);
                form.unit_id = newUnit;
            }

            unitForm.reset();
            showUnitModal.value = false;
        },
    });
};
</script>

<template>
    <Head title="Item Edit" />
    <Main>
        <h1 class="font-bold text-2xl">Edit Item</h1>
        <form @submit.prevent="updateItem" class="mt-10">
            <div class="mb-5">
                <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Nama Supplier</label
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
            <!-- Kategori -->
            <div class="mb-5">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Kategori</label
                >
                <div class="flex gap-3">
                    <div class="flex-1">
                        <VueSelect
                            class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
                            v-model="form.category_id"
                            :options="categoryOptions"
                            label="name"
                            value-by="id"
                            placeholder="Pilih kategori"
                        />
                    </div>
                    <button
                        @click="showCategoryModal = true"
                        type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
                    >
                        Tambah
                    </button>
                </div>
                <p
                    v-if="form.errors.category_id"
                    class="mt-1 text-red-500 text-sm italic"
                >
                    {{ form.errors.category_id }}
                </p>
            </div>

            <!-- Modal Tambah Kategori -->
            <div
                v-if="showCategoryModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md"
                >
                    <h2
                        class="text-xl font-bold mb-4 text-gray-800 dark:text-white"
                    >
                        Tambah Kategori
                    </h2>
                    <form @submit.prevent="storeCategory">
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                                >Nama Kategori</label
                            >
                            <input
                                v-model="categoryForm.name"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white"
                            />
                            <p
                                v-if="categoryForm.errors.name"
                                class="text-red-500 text-sm italic"
                            >
                                {{ categoryForm.errors.name }}
                            </p>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button
                                type="button"
                                @click="showCategoryModal = false"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Supplier -->
            <div class="mb-5">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Supplier
                </label>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <VueSelect
                            class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
                            v-model="form.supplier_id"
                            :options="supplierOptions"
                            label="name"
                            value-by="id"
                            placeholder="Pilih supplier"
                        />
                    </div>
                    <button
                        @click="showSupplierModal = true"
                        type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
                    >
                        Tambah
                    </button>
                </div>
                <p
                    v-if="form.errors.supplier_id"
                    class="mt-1 text-red-500 text-sm italic"
                >
                    {{ form.errors.supplier_id }}
                </p>
            </div>

            <!-- Modal Tambah supplier -->
            <div
                v-if="showSupplierModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md"
                >
                    <h2
                        class="text-xl font-bold mb-4 text-gray-800 dark:text-white"
                    >
                        Tambah Supplier
                    </h2>
                    <form @submit.prevent="storeSupplier">
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                                >Nama Supplier</label
                            >
                            <input
                                v-model="supplierForm.name"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white"
                            />
                            <p
                                v-if="supplierForm.errors.name"
                                class="text-red-500 text-sm italic"
                            >
                                {{ supplierForm.errors.name }}
                            </p>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button
                                type="button"
                                @click="showSupplierModal = false"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Warehouse -->
            <div class="mb-5">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Warehouse
                </label>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <VueSelect
                            class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
                            v-model="form.warehouse_id"
                            :options="warehouseOptions"
                            label="name"
                            value-by="id"
                            placeholder="Pilih warehouse"
                        />
                    </div>
                    <button
                        @click="showWarehouseModal = true"
                        type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
                    >
                        Tambah
                    </button>
                </div>
                <p
                    v-if="form.errors.warehouse_id"
                    class="mt-1 text-red-500 text-sm italic"
                >
                    {{ form.errors.warehouse_id }}
                </p>
            </div>

            <!-- Modal Tambah warehouse -->
            <div
                v-if="showWarehouseModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md"
                >
                    <h2
                        class="text-xl font-bold mb-4 text-gray-800 dark:text-white"
                    >
                        Tambah Warehouse
                    </h2>
                    <form @submit.prevent="storeWarehouse">
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                                >Nama Warehouse</label
                            >
                            <input
                                v-model="warehouseForm.name"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white"
                            />
                            <p
                                v-if="warehouseForm.errors.name"
                                class="text-red-500 text-sm italic"
                            >
                                {{ warehouseForm.errors.name }}
                            </p>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button
                                type="button"
                                @click="showWarehouseModal = false"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mb-5">
                <label
                    for="stock"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Stok</label
                >
                <p v-if="form.errors.stock" class="text-red-500 italic">
                    {{ form.errors.stock }}
                </p>
                <input
                    type="number"
                    id="stock"
                    v-model="form.stock"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                />
            </div>

            <div class="mb-5">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Unit
                </label>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <VueSelect
                            class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
                            v-model="form.unit_id"
                            :options="unitOptions"
                            label="name"
                            value-by="id"
                            placeholder="Pilih unit"
                        />
                    </div>
                    <button
                        @click="showUnitModal = true"
                        type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
                    >
                        Tambah
                    </button>
                </div>
                <p
                    v-if="form.errors.unit"
                    class="mt-1 text-red-500 text-sm italic"
                >
                    {{ form.errors.unit }}
                </p>
            </div>

            <!-- Modal Tambah unit -->
            <div
                v-if="showUnitModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            >
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md"
                >
                    <h2
                        class="text-xl font-bold mb-4 text-gray-800 dark:text-white"
                    >
                        Tambah Unit
                    </h2>
                    <form @submit.prevent="storeUnit">
                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                                >Nama Unit</label
                            >
                            <input
                                v-model="unitForm.name"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white"
                            />
                            <p
                                v-if="unitForm.errors.name"
                                class="text-red-500 text-sm italic"
                            >
                                {{ unitForm.errors.name }}
                            </p>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button
                                type="button"
                                @click="showUnitModal = false"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
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

<style scoped>
.vue3-select__control {
    padding: 0.625rem; /* p-2.5 */
    background-color: #f9fafb; /* bg-gray-50 */
    border: 1px solid #d1d5db; /* border-gray-300 */
    border-radius: 0.5rem; /* rounded-lg */
    font-size: 0.875rem; /* text-sm */
    color: #111827; /* text-gray-900 */
}

.dark .vue3-select__control {
    background-color: #374151; /* dark:bg-gray-700 */
    border-color: #4b5563; /* dark:border-gray-600 */
    color: #fff; /* dark:text-white */
}

.vue3-select__dropdown {
    z-index: 50;
}
</style>
