<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import Main from '../../Layouts/Main.vue';
import { route } from 'ziggy-js';
import VueSelect from "vue3-select";
import "vue3-select/dist/vue3-select.css"; // ini penting

const form = useForm({
    name: "",
    category_id: "",
    supplier_id: "",
    warehouse_id: "",
    stock: "",
    unit: ""
})

const storeItem = () => form.post(route('item.store'))

const props = defineProps({
    category: Array,
    supplier: Array,
    warehouse: Array,
    unit: Array
})

</script>

<template>
<Head title="Item Create" />
<Main>
<h1 class="font-bold text-2xl">Tambah Item</h1>
<form @submit.prevent="storeItem" class="mt-10">
  <div class="mb-5">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
      <p v-if="form.errors.name" class="text-red-500 italic">{{ form.errors.name }}</p>
    <input type="text" id="name" v-model="form.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
  </div>
   <!-- Kategori -->
      <div class="mb-5">
  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
    Kategori
  </label>
  <div class="flex gap-3">
    <div class="flex-1">
      <VueSelect
        class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
        v-model="form.category_id"
        :options="props.category"
        label="name"
        value-by="id"
        placeholder="Pilih kategori"
      />
    </div>
    <Link
      :href="route('category.create')"
      class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
    >
      Tambah
    </Link>
  </div>
  <p v-if="form.errors.category_id" class="mt-1 text-red-500 text-sm italic">
    {{ form.errors.category_id }}
  </p>
</div>


      <!-- Supplier -->
<div class="mb-5">
  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
    Supplier
  </label>
  <div class="flex gap-3">
    <div class="flex-1">
      <VueSelect
        class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
        v-model="form.supplier_id"
        :options="props.supplier"
        label="name"
        value-by="id"
        placeholder="Pilih supplier"
      />
    </div>
    <Link
      :href="route('supplier.create')"
      class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
    >
      Tambah
    </Link>
  </div>
  <p v-if="form.errors.supplier_id" class="mt-1 text-red-500 text-sm italic">
    {{ form.errors.supplier_id }}
  </p>
</div>


      <!-- Warehouse -->
<div class="mb-5">
  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
    Warehouse
  </label>
  <div class="flex gap-3">
    <div class="flex-1">
      <VueSelect
        class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
        v-model="form.warehouse_id"
        :options="props.warehouse"
        label="name"
        value-by="id"
        placeholder="Pilih warehouse"
      />
    </div>
    <Link
      :href="route('warehouse.create')"
      class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
    >
      Tambah
    </Link>
  </div>
  <p v-if="form.errors.warehouse_id" class="mt-1 text-red-500 text-sm italic">
    {{ form.errors.warehouse_id }}
  </p>
</div>

  <div class="mb-5">
      <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
      <p v-if="form.errors.stock" class="text-red-500 italic">{{ form.errors.stock }}</p>
    <input type="number" id="stock" v-model="form.stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
  </div>

  <div class="mb-5">
  <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
    Warehouse
  </label>
  <div class="flex gap-3">
    <div class="flex-1">
      <VueSelect
        class="!text-sm !rounded-lg !border-gray-300 dark:!border-gray-600 !bg-gray-50 dark:!bg-gray-700 !text-gray-900 dark:!text-white focus:!ring-blue-500 focus:!border-blue-500"
        v-model="form.unit"
        :options="props.unit"
        label="name"
        value-by="id"
        placeholder="Pilih unit"
      />
    </div>
    <Link
      :href="route('unit.create')"
      class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 rounded-lg transition"
    >
      Tambah
    </Link>
  </div>
  <p v-if="form.errors.unit" class="mt-1 text-red-500 text-sm italic">
    {{ form.errors.unit }}
  </p>
</div>

  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
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

