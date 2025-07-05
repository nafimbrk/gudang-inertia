<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const form = useForm({
    email: "",
    password: ""
})

const storeLogin = () => form.post(route('login.store'))
</script>

<template>
    <Head title="Register Account" />

                <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
  <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-6" @submit.prevent="storeLogin">
      <h5 class="text-xl font-medium text-gray-900 dark:text-white">Login</h5>

      <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <p v-if="form.errors.email" class="text-red-500 italic">{{ form.errors.email }}</p>
        <input type="email" id="email" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
      </div>

      <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <p v-if="form.errors.password" class="text-red-500 italic">{{ form.errors.password }}</p>
        <input type="password" id="password" v-model="form.password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
      </div>

      <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>

      <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
        Belum register? <Link :href="route('register')" class="text-blue-700 hover:underline dark:text-blue-500">Register</Link>
      </div>
    </form>
  </div>
</div>



</template>

<style scoped>

</style>
