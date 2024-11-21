<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-realGray dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-realGray uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-primaryColor focus:ring-offset-2 dark:focus:ring-offset-realGray disabled:opacity-50 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
