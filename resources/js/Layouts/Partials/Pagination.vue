<script setup>
import { Link } from '@inertiajs/vue3';
    defineProps(['elements']);
</script>

<template>
  <nav v-if="elements.links.length > 3" aria-label="Page navigation">
    <ul class="inline-flex -space-x-px text-base h-10">
      <template v-for="(link, key) in elements.links" :key="key">
        <li>
          <div
            v-if="link.url === null"
            class="flex items-center justify-center px-4 h-10 leading-tight text-gray-400 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500 cursor-not-allowed"
            v-html="link.label"
          />
          <Link
            v-else
            :href="link.url"
            class="flex items-center justify-center px-4 h-10 leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            :class="{
              'text-blue-600 bg-blue-50 dark:bg-gray-700 dark:text-white': link.active,
              'rounded-s-lg': key === 0,
              'rounded-e-lg': key === elements.links.length - 1
            }"
            v-html="link.label"
          />
        </li>
      </template>
    </ul>
  </nav>
</template>




