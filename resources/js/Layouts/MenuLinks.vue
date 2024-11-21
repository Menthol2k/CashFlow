<script setup>
import NavLink from '@/Components/NavLink.vue';
</script>

<template>
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </NavLink>
        <NavLink :href="route('encashments.index')" :active="route().current('encashments.index')">
            Incasari
        </NavLink>
        <NavLink :href="route('messages.index')" :active="route().current('messages.index')">
            Mesaje
        </NavLink>
        <NavLink :href="route('clients.index')" :active="route().current('clients.index')">
            Clienti
        </NavLink>
    </div>
</template>