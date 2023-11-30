<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const form = useForm({
    appName: "",
    appDescription: "",
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
    <Head title="Créer application" />
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

        <div>
            <form @submit.prevent="submit"
                class="bg-white border border-primary md:max-w-3xl m-auto pt-6 shadow-lg text-green-900 placeholder-green-700 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-5 mt-20 dark:bg-green-100 dark:border-primary"
                enctype="multipart/form-data">

                <h2 class="text-xl font-semibold mb-4">Ajouter une nouvelle application</h2>
                <div class="mb-4">
                    <label for="appName" class="block font-medium">Nom de l'application:</label>
                    <input required v-model="form.appName" type="text" id="appName"
                        class="bg-white border border-gray-300 text-gray-800 placeholder-gray-400 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-green-100 dark:border-primary">
                </div>
                <div class="mb-4">
                    <label for="appDescription" class="block font-medium">Description de l'application:</label>
                    <textarea required v-model="form.appDescription" id="appDescription"
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
                    <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-400 text-white rounded">Ajouter
                        l'application</button>
                </div>
            </form>
        </div>

    </AuthenticatedLayoutAdmin>
</template>


<style></style>
