<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import Switcher from '@/Components/Switcher.vue';

const props = defineProps({
    current_team_id: Number,
});

const form = useForm({
    team_id: props.current_team_id,
    cui: '',
    denumire: '',
    regcom: '',
    cod_client: '',
    platitor_tva: false,
    adresa: '',
    tara: '',
    judet: '',
    localitate: '',
    iban: '',
    banca: '',
    email: '',
    persoana_de_contact: '',
    telefon: '',
});

const createClient = () => {
    form.post(route('clients.store'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout title="Adaugare client">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Adaugare client
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createClient">
                    <template #title>
                        Detalii client
                    </template>

                    <template #description>
                        Adauga un client pentru a putea adauga incasari, cheltuieli in aplicatie.
                    </template>

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel value="Campurile marcare cu (*) sunt obligatorii." />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="denumire" value="Denumire firma*" />
                            <TextInput id="denumire" v-model="form.denumire" type="text" class="block w-full mt-1"
                                autofocus />
                            <InputError :message="form.errors.denumire" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="cui" value="Cod unic de identificare (CUI)*" />
                            <TextInput id="cui" v-model="form.cui" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.cui" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="regcom" value="Nr. In registrul comertului*" />
                            <TextInput id="regcom" v-model="form.regcom" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.regcom" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="cod_client" value="Cod client" />
                            <TextInput id="cod_client" v-model="form.cod_client" type="text"
                                class="block w-full mt-1" />
                            <InputError :message="form.errors.cod_client" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="adresa" value="Adresa sediului social*" />
                            <TextInput id="adresa" v-model="form.adresa" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.adresa" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="tara" value="Tara*" />
                            <TextInput id="tara" v-model="form.tara" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.tara" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="judet" value="Judet*" />
                            <TextInput id="judet" v-model="form.judet" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.judet" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="localitate" value="Localitate" />
                            <TextInput id="localitate" v-model="form.localitate" type="text"
                                class="block w-full mt-1" />
                            <InputError :message="form.errors.localitate" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="banca" value="Banca" />
                            <TextInput id="banca" v-model="form.banca" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.banca" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="banca" value="IBAN" />
                            <TextInput id="banca" v-model="form.banca" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.banca" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="persoana_de_contact" value="Persoana de contact" />
                            <TextInput id="persoana_de_contact" v-model="form.persoana_de_contact" type="text"
                                class="block w-full mt-1" />
                            <InputError :message="form.errors.persoana_de_contact" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" v-model="form.email" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="telefon" value="Numar de telefon" />
                            <TextInput id="telefon" v-model="form.telefon" type="text" class="block w-full mt-1" />
                            <InputError :message="form.errors.telefon" class="mt-2" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="telefon" value="Platitor de TVA*" />
                            <Switcher v-model="form.platitor_tva" />
                        </div>
                    </template>

                    <template #actions>
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            ADAUGA
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
