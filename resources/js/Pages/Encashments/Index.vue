<script>
import Boolean from '@/Components/Boolean.vue';
import Pagination from '@/Components/Pagination.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import moment from 'moment';

export default {
    components: {
        AppLayout, Link, Boolean, Pagination
    },

    props: {
        encashments: Object,
        total_value: Number,
    },

    methods: {
        formatMoney(value) {
            if (typeof value !== 'number') {
                value = parseFloat(value);
            }
            if (isNaN(value)) {
                return 'Invalid number';
            }
            return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').replace('.', ',');
        },
    },

    created() {
        this.moment = moment;
    }
}

</script>

<template>
    <AppLayout title="Incasari">
        <template #header>
            <h2 class="font-semibold text-xl text-realGray dark:text-gray-200 leading-tight">
                Incasari ale firmei
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="p-1 md:px-0 px-3">
                        <div class="sm:flex sm:items-center justify-end">
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <Link as="button" href="/encashments/create"
                                    class="bg-primaryColor hover:bg-darkenPrimaryColor dark:bg-darkenPrimaryColor dark:hover:bg-primaryColor focus-visible:outline-primaryColor flex justify-center items-center space-x-2 rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p>Adauga incasare</p>
                                </Link>
                            </div>
                        </div>
                        <div
                            class="-mx-4 mt-10 z-10 ring-1 bg-gray-50 dark:bg-realGray ring-gray-300 dark:ring-borderGray sm:mx-0 sm:rounded-lg overflow-x-auto">
                            <table class="min-w-full z-10 divide-y dark:divide-borderGray divide-gray-300">
                                <thead class="overflow-y-hidden">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 sm:pl-6">
                                            Client
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 sm:pl-6">
                                            TVA
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Document</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Cont bancar</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Numar document</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Data incasarii</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Valoare (RON)</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Select</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="encashments.data.length <= 0">
                                        <td colspan="7"
                                            class="px-3 text-center py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            Nu ai inregistrat incasari</td>
                                    </tr>
                                    <tr v-else v-for="encashment in encashments.data" :key="encashment.id">
                                        <td class="relative py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="font-semibold text-darkenGray dark:text-gray-200">{{
                                                encashment.client.denumire }}</div>
                                        </td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-borderColor flex items-center space-x-1">
                                            <Boolean :boolean="encashment.tva" />
                                            <p v-if="encashment.cota_tva && encashment.tva">
                                                {{ encashment.cota_tva }}%
                                            </p>
                                        </td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-borderColor lg:table-cell">
                                            {{ encashment.tip_document }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            {{ encashment.cont_bancar }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            {{ encashment.numar }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-borderColor lg:table-cell">
                                            {{ moment(encashment.data_emiterii).format('DD.MM.YYYY') }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-center text-borderColor lg:table-cell">
                                            {{ formatMoney(encashment.valoare) }}
                                        </td>
                                        <td class="relative py-3.5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <Link as="button" :href="`/encashments/${encashment.id}/edit`"
                                                class="inline-flex items-center rounded-md bg-white dark:bg-realGray px-2.5 py-1.5 text-sm font-semibold text-darkenColor dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 transition-all dark:ring-borderGray hover:bg-gray-50 dark:hover:bg-darkenGray disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            </Link>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot v-if="encashments.data.length > 1">
                                    <tr>
                                        <th scope="col"
                                            class="py-2 pl-4 pr-3 text-sm text-left font-semibold text-darkenGray dark:text-gray-200 sm:pl-6">
                                            Total
                                        </th>
                                        <th scope="col" colspan="6"
                                            class="py-2 pl-4 pr-8 text-right text-sm font-semibold text-darkenGray dark:text-gray-200 sm:pl-6">
                                            {{ formatMoney(total_value) }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <Pagination :pagination="encashments" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>