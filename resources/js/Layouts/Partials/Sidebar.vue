<script setup>
import { Link } from "@inertiajs/vue3";
import { route } from "ziggy-js";
</script>

<template>
    <aside
        id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar"
    >
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <Link
                        href="/"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    >
                        <i class="fa-solid fa-chart-simple"></i>
                        <span class="ms-3">Dashboard</span>
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('category.index')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    >
                        <i class="fa-solid fa-tag"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap"
                            >Kategori</span
                        >
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('supplier.index')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    >
                        <i class="fa-solid fa-truck-field"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap"
                            >Supplier</span
                        >
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('warehouse.index')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    >
                        <i class="fa-solid fa-building-columns"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap"
                            >Warehouse</span
                        >
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('item.index')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    >
                        <i class="fa-solid fa-box"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Item</span>
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('unit.index')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    >
                        <i class="fa-solid fa-scale-balanced"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Unit</span>
                    </Link>
                </li>
                <li>
                    <Link
                        :href="route('transaction.index')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    >
                        <i class="fa-solid fa-scale-balanced"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Transaction</span>
                    </Link>
                </li>
            </ul>
        </div>
    </aside>
</template>
