<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Footer from '@/Components/Home/Footer.vue'
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Icon from '@/Components/Icons/Icon.vue';
import { router } from "@inertiajs/vue3";
import { ref } from 'vue';

let props = defineProps({
    applications: {
        type: Array,
        default: () => ({}),
    },
});

let applications = ref(props.applications);


const getVideoThumbnailUrl = (imageName) => {
    return '/storage/images/' + imageName;
}
const getVideoUrl = (videoName) => {
    return '/storage/videos/' + videoName;
}

const pageInscription = () => {
    router.get('/entreprise/inscription');
}

// // Fonction permettant de recupérer l'actuel URL
// let currentUrl = ref('');
// const getCurrentUrl = () => {
//     currentUrl.value = window.location.href;
// }

// getCurrentUrl();

// console.log(currentUrl.value);
</script>
<template>
    <Head title="Catalogue" />

    <body class="nunito">
        <GuestLayout>
            <div class="px- py-5 container mx-auto">

                <div class="grid grid-cols-2 gap-10">
                    <div v-for="(application, index) in applications" :key="index"
                        class="grid grid-cols-1 md:grid-cols-2 bg-white p-10 gap-5 mb-8 rounded-[20px] shadow-md hover:shadow-lg md:px-7 xl:px-10">

                        <div class=" ">
                            <div class="flex gap-2 items-center mb-4">
                                <span>
                                    <Icon name="apps" />
                                </span>
                                <h1 class="text-2xl font-semibold ">{{ application.nom }}</h1>
                            </div>
                            <p class="text-gray-600 mb-4">{{ application.description }}</p>
                            <div>

                                <a class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-teal-800 focus:ring-offset-1 transition ease-in-out duration-150"
                                    href="/entreprise/inscription">
                                    Découvrir
                                </a>
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
                    </div>
                </div>
                <div v-if="applications.length == 0" class="flex justify-center h-[23.45rem] text-2xl text-center items-center">
                    Aucune application disponible pour le moment.
                </div>

            </div>


        </GuestLayout>
    </body>

    <Footer></Footer>
</template>


<style></style>
