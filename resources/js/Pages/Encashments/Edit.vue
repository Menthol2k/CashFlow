<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import Switcher from '@/Components/Switcher.vue';
import { computed, ref } from 'vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
import {
    Combobox,
    ComboboxButton,
    ComboboxInput,
    ComboboxLabel,
    ComboboxOption,
    ComboboxOptions,
} from '@headlessui/vue'

const props = defineProps({
    current_team_id: Number,
    clients: Object,
    encashment: Object,
    bank_account: String,
    selected_client: Object,
});

const query = ref('')
const filteredClients = computed(() =>
    query.value === ''
        ? props.clients
        : props.clients.filter((client) => {
            return client.denumire.toLowerCase().includes(query.value.toLowerCase())
        }),
)

const form = useForm({
    team_id: props.current_team_id,
    client: props.selected_client,
    cont_bancar: props.encashment.cont_bancar,
    tip_document: props.encashment.tip_document,
    cota_tva: props.encashment.cota_tva,
    tva: props.encashment.tva,
    data_emiterii: props.encashment.data_emiterii,
    numar: props.encashment.numar,
    valoare: props.encashment.valoare,
});

const createEncashment = () => {
    form.put(route('encashments.update', props.encashment), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :title="`Modificare incasare ${props.encashment.numar}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Modificare incasare <span class="text-primaryColor font-semibold">{{ props.encashment.numar }}</span>
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createEncashment">
                    <template #title>
                        Detalii incasare
                    </template>

                    <template #description>
                        Adauga incasare pentru a vedea statistici ajutatoare pentru firma ta.
                    </template>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel value="Campurile marcare cu (*) sunt obligatorii." />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <Combobox as="div" v-model="form.client" @update:modelValue="query = ''">
                                <ComboboxLabel class="block text-sm/6 font-medium text-gray-700 dark:text-gray-300">
                                    Client*
                                </ComboboxLabel>
                                <div class="relative mt-2">
                                    <ComboboxInput
                                        class="w-full rounded-md border-0 bg-white dark:bg-realGray py-2.5 pl-3 pr-10 text-darkenGray dark:text-gray-200 ring-2 ring-inset ring-gray-200 dark:ring-borderGray focus:ring-2 focus:ring-inset focus:ring-primaryColor sm:text-sm/6"
                                        @change="query = $event.target.value" @blur="query = ''"
                                        :display-value="(person) => person?.denumire" />
                                    <ComboboxButton
                                        class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                                        <ChevronUpDownIcon class="size-5 text-gray-400" aria-hidden="true" />
                                    </ComboboxButton>

                                    <ComboboxOptions v-if="filteredClients.length > 0"
                                        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white dark:bg-realGray py-1 text-base ring-2 ring-black/5 focus:outline-none sm:text-sm">
                                        <ComboboxOption v-for="client in filteredClients" :key="client.id"
                                            :value="client" as="template" v-slot="{ active, selected }">
                                            <li
                                                :class="['relative cursor-default select-none py-2 pl-3 pr-9', active ? 'bg-primaryColor dark:bg-darkenPrimaryColor text-white outline-none' : 'text-darkenGray dark:text-gray-20']">
                                                <span :class="['block truncate', selected && 'font-semibold']">
                                                    {{ client.denumire }}
                                                </span>

                                                <span v-if="selected"
                                                    :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-white' : 'text-primaryColor']">
                                                    <CheckIcon class="size-5" aria-hidden="true" />
                                                </span>
                                            </li>
                                        </ComboboxOption>
                                    </ComboboxOptions>
                                </div>
                                <InputError :message="form.errors.client" class="mt-2" />
                            </Combobox>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="tip_document" value="Tip document*" />
                            <TextInput id="tip_document" v-model="form.tip_document" type="text"
                                class="block w-full mt-1" placeholder="Ordin de plata, Alt document" />
                            <InputError :message="form.errors.tip_document" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="cont_bancar" value="Cont Bancar*" />
                            <TextInput id="cont_bancar" v-model="form.cont_bancar" type="text"
                                class="block w-full mt-1" />
                            <InputError :message="form.errors.cont_bancar" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="numar" value="Numar document*" />
                            <TextInput id="numar" v-model="form.numar" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.numar" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="data_emiterii" value="Data incasarii*" />
                            <TextInput id="data_emiterii" v-model="form.data_emiterii" type="date"
                                class="block w-full mt-1" />
                            <InputError :message="form.errors.data_emiterii" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="valoare" value="Valoare (RON)*" />
                            <TextInput id="valoare" v-model="form.valoare" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.valoare" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="tva" value="TVA in valoarea totala" />
                            <Switcher v-model="form.tva" />
                        </div>
                        <div v-if="form.tva" class="col-span-6 sm:col-span-4">
                            <InputLabel for="cota_tva" value="Cota TVA" />
                            <TextInput id="cota_tva" v-model="form.cota_tva" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.cota_tva" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            MODIFICA
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
