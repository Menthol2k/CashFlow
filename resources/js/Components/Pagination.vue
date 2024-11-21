<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    pagination: Object,
})
</script>


<template>
    <nav class="flex items-center w-full justify-between border-t border-gray-200 bg-gray-50 dark:bg-realGray dark:border-borderGray px-4 py-3 sm:px-6"
        aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700 dark:text-gray-400">
                Se afiseaza de la
                <span class="font-medium">{{pagination.from}}</span>
                pana la
                <span class="font-medium">{{ pagination.to }}</span>
                din
                <span class="font-medium">{{ pagination.total }}</span>
                rezultate
            </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
            <Link :href="`${pagination.links[0].url}`" v-if="pagination.links[0].url"
                class="relative inline-flex items-center rounded-md bg-white dark:bg-realGray dark:hover:bg-darkenGray dark:border-borderGray px-3 py-2 text-sm font-semibold text-darkenGray dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-borderGray transition-all hover:bg-gray-50 focus-visible:outline-offset-0">
            Pagina anterioara</Link>
            <Link :href="`${pagination.links[pagination.links.length - 1].url}`"
                v-if="pagination.links[pagination.links.length - 1].url"
                class="relative ml-3 inline-flex items-center rounded-md bg-white dark:bg-realGray dark:hover:bg-darkenGray dark:border-borderGray px-3 py-2 text-sm font-semibold text-darkenGray dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-borderGray transition-all hover:bg-gray-50 focus-visible:outline-offset-0">
            Pagina urmatoare</Link>
        </div>
    </nav>
</template>