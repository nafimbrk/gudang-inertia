<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import Main from '../../Layouts/Main.vue';
import { route } from 'ziggy-js';

const form = useForm({
    name: "",
    location: ""
})

const storeWarehouse = () => form.post(route('warehouse.store'))

</script>

<template>
<Head title="Warehouse Create" />
<Main>



<h1 class="font-bold text-2xl">Tambah Warehouse</h1>
<form @submit.prevent="storeWarehouse" class="mt-10">
  <div class="mb-5">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>
      <p v-if="form.errors.name" class="text-red-500 italic">{{ form.errors.name }}</p>
    <input type="text" id="name" v-model="form.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
  </div>
  <div class="mb-5">
      <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi</label>
      <p v-if="form.errors.location" class="text-red-500 italic">{{ form.errors.location }}</p>
    <textarea type="text" id="location" v-model="form.location" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>



</Main>
</template>
