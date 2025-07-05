<script setup>
import Navbar from './Partials/Navbar.vue';
import Sidebar from './Partials/Sidebar.vue';
</script>

<template>

    <Navbar />

    <Sidebar />

    <div class="p-8 sm:ml-64 mt-16">
        <slot />
    </div>

</template>
