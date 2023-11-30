<script setup>
import AuthenticatedLayoutAdmin from "@/Layouts/AuthenticatedLayoutAdmin.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Icon from "@/Components/Icons/Icon.vue";
import axios from "axios";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    application: {
        type: Object,
        default: () => ({}),
    },
});

let application_id = ref(props.application.id)

let nomFormation = ref('');
let descriptionFormation = ref('');

const form = useForm({
    titreVideo: "",
    urlVideo: "",
    dureeVideo: "",
    ordreVideo: "",
});

const rows = ref([]);


const addRow = () => {
    rows.value.push({
        titreVideo: "",
        urlVideo: "",
        dureeVideo: "",
        ordreVideo: "",
    });
};


const removeRow = (index) => {
    console.log(index);
    rows.value.splice(index, 1);
};

let newRow = ref([]);
let successMessage = ref('');
let errorMessage = ref('');

const submitChamp = async () => {

    for (const key in rows) {
        if (Object.hasOwnProperty.call(rows, key)) {
            newRow = rows[key];
        }
    }

    console.log(application_id.value)
    console.log(nomFormation.value)
    console.log(descriptionFormation.value)
    console.log(newRow);


    await axios
        .post(route("formation.store"), {
            application_id: application_id.value,
            nomFormation: nomFormation.value,
            descriptionFormation: descriptionFormation.value,
            newRow: newRow,
        })
        .then((response) => {
            successMessage.value = response.data.successMessage;
            errorMessage.value = response.data.errorMessage;

            // Effacement du message de notification après quelques secondes
            if (successMessage.value) {
                setTimeout(() => {
                    successMessage.value = "";
                }, 3000);
            }
            // Effacement du message de notification après quelques secondes
            if (errorMessage.value) {
                setTimeout(() => {
                    errorMessage.value = "";
                }, 3000);
            }
        });
};




</script>

<template>
    <AuthenticatedLayoutAdmin>

        <Head title="Créer une campagne" />

         <!-- Block de code permettant d'afficher les message flash-->
         <div v-if="successMessage"
            class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-primary absolute top-[5rem] right-[1rem] left-[17rem]"
            role="alert">
            <span class="sr-only">Info</span>
            <Icon name="exclam" />
            <div>
                <span class="font-medium">{{ successMessage }}</span>
            </div>
        </div>
        <div v-if="errorMessage"
            class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 absolute top-[5rem] right-[2rem] left-[18rem]"
            role="alert">
            <span class="sr-only">Info</span>
            <Icon name="exclam" />
            <div>
                <span class="font-medium">{{ errorMessage }}</span>
            </div>
        </div>

        <form @submit.prevent="submitChamp()"
            class="bg-gray-50 bg-opacity-80 max-w-full md:max-w-3xl m-auto mt-20 pt-6 shadow-lg p-6">


            <div class="flex flex-col justify-between">
                <h1 class=" text-xl font-bold mb-10">Créer la formation sur l'application {{ application.nom }}</h1>

                <div>
                    <div class="mb-4">
                        <InputLabel for="nomFormation" value="Titre de la formation" />
                        <TextInput id="nomFormation" type="text" class="mt-1 block w-full" v-model="nomFormation" required
                            autocomplete="groupe" />

                        <InputError class="mt-2" :message="form.errors.nomFormation" />
                    </div>
                    <div class="mb-4">
                        <InputLabel for="descriptionFormation" value="Description de la formation" />
                        <textarea id="descriptionFormation" type="text"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                            v-model="descriptionFormation" required autocomplete="groupe"></textarea>

                        <InputError class="mt-2" :message="form.errors.descriptionFormation" />
                    </div>
                </div>

                <button @click="addRow"
                    class="border h-10 rounded-lg justify-center flex items-center bg-yellow-600 text-white px-5 mb-3">
                    Ajouter une ou plusieurs video(s) de formation
                </button>
            </div>

            <div class="grid grid-cols-4 ">
                <InputLabel for="titreVideo" value="Titre de la vidéo" />
                <InputLabel class="" for="urlVideo" value="Url de la vidéo" />
                <InputLabel class="" for="dureeVideo" value="Durée de la vidéo" />
                <InputLabel class="" for="ordreVideo" value="Numéro d'ordre" />
            </div>

            <div v-for="(row, index) in rows" :key="index" class="flex gap-10 mb-2 row">
                <div class="w-full flex gap-2">

                    <!-- Première input -->
                    <div class="w-md">
                        <TextInput id="titreVideo" type="text" class="mt-1 block w-full" v-model="row.titreVideo" required
                            autofocus autocomplete="titreVideo" />

                        <InputError class="mt-2" :message="form.errors.titreVideo" />
                    </div>


                    <!-- Deuxième input -->
                    <div>
                        <TextInput id="urlVideo" type="text" class="mt-1 block w-full" v-model="row.urlVideo"
                            autocomplete="urlVideo" />

                        <InputError class="mt-2" :message="form.errors.urlVideo" />
                    </div>


                    <!-- Troisème input -->
                    <div>
                        <TextInput id="dureeVideo" type="text" class="mt-1 block w-full" v-model="row.dureeVideo"
                            autocomplete="dureeVideo" />

                        <InputError class="mt-2" :message="form.errors.dureeVideo" />
                    </div>

                    <!-- Quatrième input -->
                    <div>
                        <TextInput id="ordreVideo" type="text" class="mt-1 block w-full" v-model="row.ordreVideo"
                            autocomplete="ordreVideo" />

                        <InputError class="mt-2" :message="form.errors.ordreVideo" />
                    </div>


                    <span @click="removeRow(index)" class="relative cursor-pointer left-1 top-4">
                        <Icon name="deleteIcon" />
                    </span>
                </div>

            </div>

            <div class="flex justify-end">
                <PrimaryButton class="ml-4 my-6" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Créer
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayoutAdmin>
</template>
