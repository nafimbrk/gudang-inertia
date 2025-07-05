<script setup>
import { Link } from '@inertiajs/vue3';
    defineProps(['elements']);
</script>

<template>
    <div v-if="elements.links.length > 3" id="pagination" class="...">
  <div id="pagination" class="w-full flex justify-center pt-4 items-center">
    <div class="flex flex-wrap mb-1">
      <template v-for="(link, key) in elements.links" :key="key">
        <div v-if="link.url === null"
          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
          v-html="link.label" />
        <Link v-else
          class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-200 focus:border-indigo-500 focus:text-indigo-500"
          :class="{ 'bg-blue-500 text-white': link.active }"
          :href="link.url"
          v-html="link.label" />
      </template>
    </div>
  </div>
  </div>
</template>



<!-- <template>
  <div id="pagination" class="w-full flex justify-center border-t border-gray-100 pt-4 items-center">
    <div class="flex flex-wrap">
      <template v-for="(link, key) in elements.links" :key="key">

        <div
          v-if="link.url === null"
          class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 rounded"
          v-html="link.label"
        />

        <Link
          v-else
          :href="link.url"
          class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
          :class="{
            'text-red-900 bg-slate-600': link.active
          }"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>


 -->
