<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    tva: Number,
    taxa_venit: Number,
    profit_net: Number
});

const formatMoney = (value) => {
    if (typeof value !== 'number') {
        value = parseFloat(value);
    }
    if (isNaN(value)) {
        return 'Invalid number';
    }
    return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').replace('.', ',');
};

var stats = [
    { name: 'TVA', stat: `${formatMoney(props.tva)} LEI` },
    { name: 'Taxa pe venit (3%)', stat: `${formatMoney(props.taxa_venit)} LEI` },
    { name: 'Profit NET', stat: `${formatMoney(props.profit_net)} LEI` },
]
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-realGray dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div>
                        <h3 class="text-base font-semibold text-darkenGray dark:text-gray-200">Taxe de platit</h3>
                        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                            <div v-for="item in stats" :key="item.name"
                                class="overflow-hidden rounded-lg dark:bg-realGray bg-white px-4 py-5 shadow sm:p-6">
                                <dt class="truncate text-sm font-medium text-gray-500">{{ item.name }}</dt>
                                <dd class="mt-1 text-3xl font-semibold tracking-tight text-darkenGray dark:text-gray-200">{{ item.stat }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
