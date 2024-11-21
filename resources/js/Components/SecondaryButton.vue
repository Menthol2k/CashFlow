<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-200 border border-gray-300 dark:border-borderGray rounded-md font-semibold text-xs text-darkenGray dark:text-realGray uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-primaryColor focus:ring-offset-2 dark:focus:ring-offset-white-200 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
