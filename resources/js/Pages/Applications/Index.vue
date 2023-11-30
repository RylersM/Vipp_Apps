<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Icon from '@/Components/Icons/Icon.vue';
import { router } from "@inertiajs/vue3";
import Swal from 'sweetalert2'
import axios from 'axios';
import { onMounted, ref } from 'vue';

let props = defineProps({
    applications: {
        type: Array,
        default: () => ({}),
    },
});



// ********************************************** //
// Fonctions d'affichage des applications
let applications = ref(props.applications);
console.log(applications.value);

const getVideoThumbnailUrl = (imageName) => {
    return '/storage/images/' + imageName;
}
const getVideoUrl = (videoName) => {
    return '/storage/videos/' + videoName;
}

const showDetails = (uuid) => {
    router.get(route("formation", {
        uuid: uuid,
        backUrl: currentUrl.value
    }));
}

// Fonction permettant de recupérer l'actuel URL
let currentUrl = ref('');
const getCurrentUrl = () => {
    currentUrl.value = window.location.href;
}

getCurrentUrl();

let varShowPopup = ref([]);
let varShowEditModal = ref(false);

const showPopup = (index) => {
    varShowPopup.value[index] = !varShowPopup.value[index];
}

let app_name = ref('');
let app_description = ref('');

const fillEditForm = (application) => {
    app_name.value = application.nom;
    app_description.value = application.description;
    // Vous pouvez ajouter d'autres champs si nécessaire
};

const editApplication = (id) => {
    varShowEditModal.value = !varShowEditModal.value;

    axios.post('/application/edit', {
        application_id: id
    }).then((response) => {
        fillEditForm(response.data); // Remplir le formulaire avec les données récupérées
        console.log(app_name.value);
    })

}

const closeModal = () => {
    varShowEditModal.value = !varShowEditModal.value;
}

// Fonction de supprimer
const deleteApplication = (id, application) => {
    Swal.fire({
        title: 'Etes vous sûr?',
        text: `De vouloir supprimer l'application ${application}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annuler',
        confirmButtonText: 'Oui, supprimer!'
    }).then((result) => {

        if (result.isConfirmed) {
            axios.get('/application/delete', {
                application_id: id
            }).then(response => {

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Application supprimé avec succès',
                    showConfirmButton: false,
                    timer: 2000
                })
            }).catch(function (error) {

                Swal.fire(
                    'Oups!',
                    'Un probleme est survenue lors de la suppression de votre application.',
                    'error'
                )
            })
        }
    })

}


// ************************************************ //
// ##  Edition d'applications
console.log(app_name.value);
const form = useForm({
    appName: app_name.value,
    appDescription: app_description.value,
    captureEcran: null,
    videoDemo: null,
});


const handleCaptureEcranChange = (event) => {
    form.captureEcran = event.target.files[0];
};

const handleVideoDemoChange = (event) => {
    form.videoDemo = event.target.files[0];
};


let successMessage = ref("");
let errorMessage = ref("");

const submit = async () => {
    let formData = new FormData();

    formData.append('appName', form.appName.trim());
    formData.append('appDescription', form.appDescription.trim());
    formData.append('captureEcran', form.captureEcran);
    formData.append('videoDemo', form.videoDemo);

    axios.post(route('application.store'), formData, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    }).then((response) => {

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

        form.appName = "";
        form.appDescription = "";
        form.captureEcran = null;
        form.videoDemo = null;
    })

};







</script>
<template>
    <Head title="Applications" />
    <AuthenticatedLayoutAdmin>
        <div class="px-10 py-5">

            <div class="grid grid-cols-2 gap-10">
                <div v-for="(application, index) in applications" :key="index"
                    class=" relative  grid grid-cols-1 md:grid-cols-2 bg-white p-5 gap-5 shadow-lg rounded-lg">

                    <div class=" ">
                        <div class="flex gap-2 items-center mb-4">
                            <span>
                                <Icon name="apps" />
                            </span>
                            <h1 class="text-2xl font-semibold ">{{ application.nom }}</h1>
                        </div>
                        <p class="text-gray-600 mb-4 truncat">{{ application.description }}</p>
                        <div>
                            <PrimaryButton @click="showDetails(application.uuid)">
                                Découvrir
                            </PrimaryButton>
                        </div>
                    </div>

                    <div class="">
                        <h2 class="text-lg font-semibold mb-2">Vidéo de démonstration</h2>
                        <div class="">
                            <video controls :poster="getVideoThumbnailUrl(application.capture_ecran)">
                                <source :src="getVideoUrl(application.video_demo)" type="video/mp4">
                            </video>
                        </div>
                    </div>

                    <div class="absolute top-2 right-5 cursor-pointer" @click="showPopup(index)">
                        <Icon name="parameters" />
                    </div>



                    <div v-if="varShowPopup[index]"
                        class="flex flex-col justify-start items-start bg-white absolute -right-4 top-10 p-2 border rounded-md shadow-lg">
                        <button @click="editApplication(application.id, application.nom)"
                            class="hover:underline  text-slate-500">Éditer</button>
                        <button @click="deleteApplication(application.id, application.nom)"
                            class="hover:underline text-red-500">Supprimer</button>
                    </div>

                </div>
                <div v-if="applications.length === 0" class="z-40  inset-1 flex items-center text-xl justify-center">
                    Aucune application existant !
                </div>
            </div>

        </div>



        <div v-if="varShowEditModal"
            class="fixed top-0 left-0 z-50 w-full h-full flex items-center justify-center bg-black bg-opacity-50">


            <div
                class="bg-white border relative border-primary md:max-w-3xl m-auto pt-6 shadow-lg text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-5 dark:bg-green-100 dark:border-primary"
                enctype="multipart/form-data">

                <span @click="closeModal()" class="absolute top-5 right-5 cursor-pointer">
                    <Icon name="closeBtn" />
                </span>

                <h2 class="text-xl font-semibold mb-4">Editon de l'application</h2>

           
                <div class="mb-4">
                    <label for="appName" class="block font-medium">Nom de l'application:</label>
                    <input required v-model="app_name"  type="text" id="appName"
                        class="bg-white border border-gray-300 text-gray-800 placeholder-gray-400 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-green-100 dark:border-primary">
                </div>
                <div class="mb-4">
                    <label for="appDescription" class="block font-medium">Description de l'application:</label>
                    <textarea required v-model="app_description" id="appDescription"
                        class="bg-white border border-gray-300 text-gray-800 placeholder-gray-400 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-green-100 dark:border-primary h-24"></textarea>
                </div>
                <div class="mb-4">
                    <label for="captureEcran" class="block font-medium">Capture d'écran:</label>
                    <input required type="file" id="captureEcran" @change="handleCaptureEcranChange"
                        class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                </div>
                <div class="mb-4">
                    <label for="videoDemo" class="block font-medium">Vidéo de démonstration:</label>
                    <input required type="file" id="videoDemo" @change="handleVideoDemoChange"
                        class="block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">

                </div>


                <div class="flex justify-end">
                    <span @click="submit"
                        class="cursor-pointer px-4 py-2 bg-yellow-600 hover:bg-yellow-500 text-white rounded">Enrégistrer
                    </span>
                </div>
            </div>

        </div>


    </AuthenticatedLayoutAdmin>
</template>


<style></style>
