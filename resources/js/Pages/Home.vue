<script setup>
import Main from "../Layouts/Main.vue";
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps({
    totalCategory: Object,
    totalSupplier: Object,
});

const page = usePage()

const user = computed(() => page.props.auth.user)
</script>

<template>
    <Head title="Dashboard" />
    <Main>
        <h1 class="font-bold text-2xl mb-10">Welcome {{ user.name }}</h1>
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div
                class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800"
            >
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    Kategori {{ totalCategory }}
                </p>
            </div>
            <div
                class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800"
            >
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    Supplier {{ totalSupplier }}
                </p>
            </div>
        </div>
    </Main>
</template>
