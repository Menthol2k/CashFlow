<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="'/'">
    <img class="dark:hidden relative max-w-xs" src="/storage/logos/white_mode_logo.png" />
    <img class="dark:block hidden max-w-xs" src="/storage/logos/dark_mode_logo.png" />
    </Link>
</template>
