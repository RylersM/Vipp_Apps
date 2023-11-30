<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Icon from '@/Components/Icons/Icon.vue';
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

let props = defineProps({


    application: {
        type: Object,
        default: () => ({}),
    },

    formation: {
        type: Object,
        default: () => ({}),
    },

    module: {
        type: Object,
        default: () => ({}),
    },

    videos: {
        type: Object,
        default: () => ({}),
    },

    backUrl: {
        type: String,
        default: '',
    },

});


console.log(props.application,);
console.log(props.formation);
console.log(props.module);
console.log(props.videos);
console.log(props.backUrl);

let videos = ref(props.videos);
let module = ref(props.module);



const form = useForm({
    titre: "",
    url: "",
    duree: "",
    ordre: "",
});

const rows = ref([]);


const addRow = () => {
    if (rows.value.length < 12) {
        rows.value.push({
            titre: "",
            url: "",
            duree: "",
            ordre: "",
        });
    }
};


const removeRow = (index) => {
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
    console.log(newRow);


    await axios
        .post(route("videos.store"), {
            module_id: props.module.id,
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

            axios.post('/getvideos', {
                id_module: props.module.id,
            }).then(response => {
                videos.value = response.data.videos;
                console.log(videos.value);
            })

            fermerModal();
        });
};

axios.post('/getvideos', {
    id_module: props.module.id,
}).then(response => {
    videos.value = response.data.videos;
    console.log(videos.value);
})



const selectedVideoUrl = ref('');
const selectedVideoTitre = ref('');



const showvideos = (url, titre) => {
    selectedVideoUrl.value = url;
    selectedVideoTitre.value = titre;
};

const closeModal = () => {
    selectedVideoUrl.value = '';
};


let modalVisible = ref('');
const ouvrirModal = () => {
    modalVisible.value = true;
};

const fermerModal = () => {
    modalVisible.value = false;
};




// Fonction permettant d'aller à la page précedente
const pagePrécedente = () => {
    // Rediriger l'utilisateur vers l'URL précédente
    window.location.href = props.backUrl;
}

</script>
<template>
    <Head title="Modules" />
    <AuthenticatedLayoutAdmin>
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

        <div class="text-start text-sm text-red-900 font-semibold  font-mono mt-2">
            # {{ props.application.nom}} / {{ props.formation.titre}} / {{ props.module.titre }}
        </div>

        <div class="flex justify-between gap-5 mt-2">

            <PrimaryButton @click="ouvrirModal()">
                Ajouter une vidéo
            </PrimaryButton>
            <PrimaryButton class="flex gap-1 items-center justify-center" @click="pagePrécedente()">
                <span>Retour</span>
                <Icon name="back" />
            </PrimaryButton>

        </div>


        <div class="shadow mt-5">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Titre de la videos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                URL
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Durée
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Ordre
                            </th>

                            <th scope="col" class="px-6 py-3">
                                <span class="flex justify-center">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="video, index in videos" :key="index"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th @click="showvideos(video.url, video.titre)" scope="row"
                                class="px-6 py-4 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                {{ video.titre }}
                            </th>
                            <th @click="showvideos(video.url, video.titre)" scope="row"
                                class="px-6 py-4 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                {{ video.url }}
                            </th>
                            <th @click="showvideos(video.url, video.titre)" scope="row"
                                class="px-6 py-4 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                {{ video.duree }}
                            </th>
                            <th @click="showvideos(video.url, video.titre)" scope="row"
                                class="px-6 py-4 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                {{ video.ordre }}
                            </th>



                            <td class="flex justify-center gap-10 px-6 py-4 text-right">
                                <a href="#"
                                    class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</a>

                                <a href="#"
                                    class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>



        <div v-if="modalVisible == true"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 ">

            <div v-if="modalVisible == true" class="  relative bg-white  p-8 rounded-lg shadow-lg">


                <span @click="fermerModal" class="absolute top-2 right-2 ">
                    <Icon name="closeBtn" />
                </span>
                <button @click="addRow"
                    class=" sticky top-0 border w-full h-10 rounded-lg justify-center flex items-center bg-yellow-600 text-white px-5 mb-3">
                    Ajouter une ou plusieurs vidéo(s)
                </button>

                <div class="w-[1000px] flex flex-col justify-between">
                    <form @submit.prevent="submitChamp()">

                        <div class="grid grid-cols-4 ">
                            <InputLabel for="titre" value="Titre de la vidéo" />
                            <InputLabel class="" for="url" value="Url de la vidéo" />
                            <InputLabel class="" for="duree" value="Durée de la vidéo" />
                            <InputLabel class="" for="ordre" value="Numéro d'ordre" />
                        </div>

                        <div v-for="(row, index) in rows" :key="index" class="flex gap-10 mb-2 row">
                            <div class="w-full flex ">

                                <div class="w-full grid grid-cols-4 gap-2">
                                    <!-- Première input -->
                                    <div class="w-md">
                                        <TextInput id="titre" type="text" class="mt-1 block w-full" v-model="row.titre"
                                            required autofocus autocomplete="titre" />

                                        <InputError class="mt-2" :message="form.errors.titre" />
                                    </div>


                                    <!-- Deuxième input -->
                                    <div>
                                        <TextInput id="url" type="text" class="mt-1 block w-full" v-model="row.url"
                                            autocomplete="url" />

                                        <InputError class="mt-2" :message="form.errors.url" />
                                    </div>


                                    <!-- Troisème input -->
                                    <div>
                                        <TextInput id="duree" type="text" class="mt-1 block w-full" v-model="row.duree"
                                            autocomplete="duree" />

                                        <InputError class="mt-2" :message="form.errors.duree" />
                                    </div>

                                    <!-- Quatrième input -->
                                    <div>
                                        <TextInput id="ordre" type="text" class="mt-1 block w-full" v-model="row.ordre"
                                            autocomplete="ordre" />

                                        <InputError class="mt-2" :message="form.errors.ordre" />
                                    </div>

                                </div>

                                <span @click="removeRow(index)" class="relative cursor-pointer left-1 top-4">
                                    <Icon name="deleteIcon" />
                                </span>
                            </div>

                        </div>

                        <div class="flex justify-end sticky bottom-0">
                            <PrimaryButton class="ml-4 my-6" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Créer
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <div v-if="selectedVideoUrl" class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class=" relative p-8 bg-white rounded-lg">
                <span @click="closeModal" class="absolute top-2 right-2">
                    <Icon name="closeBtn" />
                </span>
                <p class="text-center font-bold text-xl text-slate-800 mb-1 italic">{{ selectedVideoTitre }}</p>
                <iframe :src="selectedVideoUrl" class="w-[800px] h-[450px]"></iframe>
            </div>
        </div>

    </AuthenticatedLayoutAdmin>
</template>


<style></style>
