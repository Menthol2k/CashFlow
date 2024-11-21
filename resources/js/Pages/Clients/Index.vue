<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import Boolean from '@/Components/Boolean.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout, Pagination, Boolean, Link
    },

    props: {
        clients: Object,
    }
}

</script>

<template>
    <AppLayout title="Clienti">
        <template #header>
            <h2 class="font-semibold text-xl text-realGray dark:text-gray-200 leading-tight">
                Nomenclator clienti
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="p-1 md:px-0 px-3">
                        <div class="sm:flex sm:items-center justify-end">
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <Link as="button" href="/clients/create"
                                    class="bg-primaryColor hover:bg-darkenPrimaryColor dark:bg-darkenPrimaryColor dark:hover:bg-primaryColor focus-visible:outline-primaryColor flex justify-center items-center space-x-2 rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                <p>Adauga client</p>
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
                                            Denumire
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 sm:pl-6">
                                            CUI
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Reg. Com</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Platitor TVA</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Locatie</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Persoana de contact</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Telefon</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Select</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="clients.data.length <= 0">
                                        <td colspan="7"
                                            class="px-3 text-center py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            Nu exista clienti</td>
                                    </tr>
                                    <tr v-else v-for="client in clients.data" :key="client.id">
                                        <td class="relative py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="font-semibold text-darkenGray dark:text-gray-200">{{
                                                client.denumire }}</div>
                                        </td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-borderColor lg:table-cell">
                                            {{ client.cui }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            {{ client.regcom }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-borderColor lg:table-cell">
                                            <Boolean :boolean="client.platitor_tva" />
                                        </td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-borderColor lg:table-cell">
                                            {{ client.judet }}, {{ client.tara }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-center text-borderColor lg:table-cell">
                                            {{ client.persoana_de_contact ? client.persoana_de_contact : 'Nu exista' }}
                                        </td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            {{ client.telefon ? client.telefon : 'Nu exista' }}</td>
                                        <td class="relative py-3.5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <Link as="button" :href="`/clients/${client.id}/edit`"
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
                            </table>
                            <Pagination :pagination="clients" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
