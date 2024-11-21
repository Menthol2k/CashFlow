<script>
import Pagination from '@/Components/Pagination.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import moment from 'moment';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { throttle } from 'lodash';
import { pickBy } from 'lodash';
import { router } from '@inertiajs/vue3';
import axiosLink from '@/axiosLink';

export default {

    components: {
        AppLayout, Pagination, Menu, MenuButton,
        MenuItem, MenuItems, ChevronDownIcon
    },

    props: {
        messages: Object,
        filters: Object,
    },

    data() {
        return {
            loading: false,
            params: {
                type: this.filters.type,
            }
        }
    },

    methods: {
        syncMessages() {
            this.loading = true;
            axios.get('/messages/sync')
                .then((response) => {
                    console.log(response.data.message);
                })
                .catch((errors) => {
                    console.error(errors);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        setTypeFilter(type) {
            if (type == this.params.type) {
                this.params.type = null;
            } else {
                this.params.type = type;
            }
        },
        downloadInvoice(id) {
            axiosLink(`/messages/${id}/invoice`, `eFactura_${id}.zip`);
        }
    },

    created() {
        this.moment = moment;
    },

    watch: {
        params: {
            deep: true,
            handler: throttle((theObject) => {
                let query = pickBy(theObject);
                router.get('messages', Object.keys(query).length > 0 ? query : { remember: 'forget' }, { preserveState: true });
            }, 150)
        }
    }
}

</script>

<template>
    <AppLayout title="Mesaje">
        <template #header>
            <h2 class="font-semibold text-xl text-realGray dark:text-gray-200 leading-tight">
                Mesaje din SPV
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="p-1 md:px-0 px-3">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-base font-semibold text-darkenColor dark:text-gray-200">Mesaje</h1>
                                <p class="mt-2 text-sm text-borderGray dark:text-gray-400">In aceasta sectiune vi se vor
                                    afisa
                                    mesaje primite din SPV, alaturi de document.</p>
                            </div>
                            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                <button type="button" @click="syncMessages"
                                    :class="loading ? 'bg-gray-500 cursor-no-drop hover:bg-gray-400 dark:bg-borderGray dark:hover:bg-realGray' : 'bg-primaryColor hover:bg-darkenPrimaryColor dark:bg-darkenPrimaryColor dark:hover:bg-primaryColor focus-visible:outline-primaryColor'"
                                    class="flex justify-center items-center space-x-2 rounded-md px-3 py-2 text-center text-sm font-semibold text-white shadow-sm transition-all focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2.5" stroke="currentColor" class="size-4"
                                        :class="loading ? 'animate-spin' : ''">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    <p>Sincronizare</p>
                                </button>

                            </div>
                        </div>
                        <div
                            class="-mx-4 mt-10 z-10 ring-1 bg-gray-50 dark:bg-realGray ring-gray-300 dark:ring-borderGray sm:mx-0 sm:rounded-lg overflow-x-auto">
                            <table class="min-w-full z-10 divide-y dark:divide-borderGray divide-gray-300">
                                <thead class="overflow-y-hidden">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 sm:pl-6">
                                            ID Solicitare
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            <Menu as="div" class="relative inline-block text-left">
                                                <div>
                                                    <MenuButton
                                                        :class="params.type ? 'bg-primaryColor text-darkenGray px-3 rounded-lg' : ''"
                                                        class="flex items-center rounded-full text-darkenGray dark:text-gray-200 focus:outline-none">
                                                        <span>Tip</span>
                                                        <ChevronDownIcon class="size-5" aria-hidden="true" />
                                                    </MenuButton>
                                                </div>

                                                <transition enter-active-class="transition ease-out duration-100"
                                                    enter-from-class="transform opacity-0 scale-95"
                                                    enter-to-class="transform opacity-100 scale-100"
                                                    leave-active-class="transition ease-in duration-75"
                                                    leave-from-class="transform opacity-100 scale-100"
                                                    leave-to-class="transform opacity-0 scale-95">
                                                    <MenuItems
                                                        class="absolute -right-40 z-[100] mt-2 w-56 origin-top-right rounded-md bg-white dark:bg-darkenGray shadow-lg ring-1 ring-black/5 focus:outline-none">
                                                        <div class="py-1">
                                                            <MenuItem>
                                                            <button type="button"
                                                                @click="setTypeFilter('FACTURA PRIMITA')"
                                                                :class="[params.type == 'FACTURA PRIMITA' ? 'bg-gray-100 dark:bg-realGray text-darkenGray dark:text-gray-200 outline-none' : 'text-gray-700 dark:text-gray-300', 'block px-4 py-2 text-sm w-full text-left']">Facturi
                                                                Primite</button>
                                                            </MenuItem>
                                                            <MenuItem>
                                                            <button type="button"
                                                                @click="setTypeFilter('FACTURA TRIMISA')"
                                                                :class="[params.type == 'FACTURA TRIMISA' ? 'bg-gray-100 dark:bg-realGray text-darkenGray dark:text-gray-200 outline-none' : 'text-gray-700 dark:text-gray-300', 'block px-4 py-2 text-sm w-full text-left']">Facturi
                                                                Trimise</button>
                                                            </MenuItem>
                                                        </div>
                                                    </MenuItems>
                                                </transition>
                                            </Menu>
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Data primire</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-darkenGray dark:text-gray-200 lg:table-cell">
                                            Detalii</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Select</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="messages.data.length <= 0">
                                        <td colspan="5"
                                            class="px-3 text-center py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            Nu exista mesaje</td>
                                    </tr>
                                    <tr v-else v-for="message in messages.data" :key="message.id">
                                        <td class="relative py-4 pl-4 pr-3 text-sm sm:pl-6">
                                            <div class="font-semibold text-darkenGray dark:text-gray-200">{{
                                                message.id_solicitare }}</div>
                                        </td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300 text-borderColor lg:table-cell">
                                            {{ message.type }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            {{ moment(message.date).format('DD.MM.YYYY HH:mm') }}</td>
                                        <td
                                            class="px-3 py-3.5 text-sm dark:text-gray-300  text-borderColor lg:table-cell">
                                            {{ message.details }}</td>
                                        <td class="relative py-3.5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <button type="button" @click="downloadInvoice(message.id_spv)"
                                                class="inline-flex items-center rounded-md bg-white dark:bg-realGray px-2.5 py-1.5 text-sm font-semibold text-darkenColor dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 transition-all dark:ring-borderGray hover:bg-gray-50 dark:hover:bg-darkenGray disabled:cursor-not-allowed disabled:opacity-30 disabled:hover:bg-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination :pagination="messages" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>