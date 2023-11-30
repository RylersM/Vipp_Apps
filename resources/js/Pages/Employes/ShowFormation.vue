<script setup>
import AuthenticatedLayoutEmploye from '@/Layouts/AuthenticatedLayoutEmploye.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, computed, onBeforeMount } from 'vue';

let props = defineProps({
    formation: {
        type: Object,
        default: () => ({}),
    },
});

let selectedModule = ref(null);
let selectedVideo = ref(null);

// Sélectionnez la première vidéo du premier module au chargement initial
onMounted(() => {

    if (props.formation.modules.length > 0 && props.formation.modules[0].videos.length > 0) {
        selectedModule.value = props.formation.modules[0];
        selectedVideo.value = props.formation.modules[0].videos[0];
    }
});


function toggleModule(module) {
    selectedModule.value = selectedModule.value === module ? null : module;
}

function selectVideo(video) {
    selectedVideo.value = video;
    localStorage.setItem('selectedVideoId', video.id);
}

// Fonction pour mettre en évidence le titre de la vidéo en cours de lecture
const isVideoPlaying = (video) => {
    // Vérifiez si la vidéo passée en paramètre correspond à la vidéo sélectionnée
    return selectedVideo.value && selectedVideo.value.id === video.id;
};

// Fonction permettant d'aller à la vidéo précedente ou la vidéo suivante

function previousVideo() {
    if (selectedModule.value && selectedVideo.value) {
        const moduleIndex = props.formation.modules.indexOf(selectedModule.value);
        const videoIndex = selectedModule.value.videos.indexOf(selectedVideo.value);

        if (videoIndex > 0) {
            // Il y a une vidéo précédente dans le module actuel
            selectedVideo.value = selectedModule.value.videos[videoIndex - 1];
        } else if (moduleIndex > 0) {
            // Pas de vidéo précédente dans le module actuel, mais il y a un module précédent
            const previousModule = props.formation.modules[moduleIndex - 1];
            selectedModule.value = previousModule;
            selectedVideo.value = previousModule.videos[previousModule.videos.length - 1];
        }
    }
}

function nextVideo() {
    if (selectedModule.value && selectedVideo.value) {
        const moduleIndex = props.formation.modules.indexOf(selectedModule.value);
        const videoIndex = selectedModule.value.videos.indexOf(selectedVideo.value);

        if (videoIndex < selectedModule.value.videos.length - 1) {
            // Il y a une vidéo suivante dans le module actuel
            selectedVideo.value = selectedModule.value.videos[videoIndex + 1];
        } else if (moduleIndex < props.formation.modules.length - 1) {
            // Pas de vidéo suivante dans le module actuel, mais il y a un module suivant
            const nextModule = props.formation.modules[moduleIndex + 1];
            selectedModule.value = nextModule;
            selectedVideo.value = nextModule.videos[0];
        }
    }
}

// Variables calculées pour déterminer si les boutons Précédent et Suivant doivent être visibles.
const canShowPreviousButton = computed(() => {
    if (selectedModule.value && selectedVideo.value) {
        const moduleIndex = props.formation.modules.indexOf(selectedModule.value);
        const videoIndex = selectedModule.value.videos.indexOf(selectedVideo.value);
        return videoIndex > 0 || (moduleIndex > 0 && videoIndex === 0);
    }
    return false;
});

const canShowNextButton = computed(() => {
    if (selectedModule.value && selectedVideo.value) {
        const moduleIndex = props.formation.modules.indexOf(selectedModule.value);
        const videoIndex = selectedModule.value.videos.indexOf(selectedVideo.value);
        return (
            videoIndex < selectedModule.value.videos.length - 1 ||
            (moduleIndex < props.formation.modules.length - 1 && videoIndex === selectedModule.value.videos.length - 1)
        );
    }
    return false;
});

// Variable d'état pour suivre l'affichage des modules
const areModulesExpanded = ref(false);

// Méthode pour basculer l'état des modules (déplier ou masquer)
const toggleModules = () => {
    areModulesExpanded.value = !areModulesExpanded.value;
};

</script>
<template>
    <AuthenticatedLayoutEmploye>

        <Head :title="formation.titre" />

        <div class="flex mt-5 justify-between w-full h-[97%] ">
            <!-- Contenu de la vidéo à gauche -->
            <div class="w-8/12 container mx-auto flex flex-col gap-5">

                <div class="bg-red-100 p-2 rounded-full px-5">
                    <h1 class="text-red-700">Titre de la formation : <span class="font-bold text-xl">{{ formation.titre }}</span></h1>
                </div>

                <div class=" text-center flex justify-center flex-col ">
                    <h2 class="text-4xl font-bold text-primary">{{ selectedVideo ? selectedVideo.titre : '' }}</h2>
                    <div class="mt-5 flex justify-center">
                        <iframe v-if="selectedVideo" :src="selectedVideo.url" width="940" height="530" frameborder="0"
                            allowfullscreen></iframe>

                        <!-- <object
                        v-if="selectedVideo"
                        :data="selectedVideo.url"
                        width="640"
                        height="360"
                        allowfullscreen
                        ></object> -->

                    </div>
                </div>

                <!-- Boutons Suivant et Précédent -->
                <div class="mt-4 container mx-auto flex-end flex justify-between px-5">
                    <button v-if="canShowPreviousButton" :class="{ 'flex justify-start': !canShowPreviousButton }"
                        class="px-4 py-2 shadow-md font-bold hover:shadow-amber-500 hover:border-0 border-2 rounded-full"
                        @click="previousVideo">
                        Précédent
                    </button>
                    <button v-if="canShowNextButton" :class="{ 'flex justify-end': !canShowNextButton }"
                        class="px-4 py-2 text-end shadow-md font-bold hover:shadow-amber-500 hover:border-0 border-2 rounded-full"
                        @click="nextVideo">
                        Suivant
                    </button>
                </div>

            </div>


            <!-- Liste des modules à droite -->
            <div class="w-3/12 p-4 shadow h-full ">
                <h1 class="text-3xl font-bold mb-4 truncate text-primary">{{ formation.titre }}</h1>
                <button @click="toggleModules" class="text-sm mb-5 text-slate-500">
                    {{ areModulesExpanded ? 'Masquer tous les modules' : 'Afficher tous les modules' }}
                </button>

                <div v-for="module, index in formation.modules" :key="module.id">
                    <div class=" flex flex-col shadow py-4 font-bold text-[#4b39ef] px-2 mb-2 cursor-pointer truncate rounded"
                        @click="toggleModule(module)">
                        <span class="text-black font-light italic">Module {{ index + 1 }} :</span>
                        {{ module.titre }}
                    </div>
                    <div v-if="areModulesExpanded || module === selectedModule">
                        <div v-for="video in module.videos" :key="video.id" class="ml-4">
                            <div class="flex mb-2 text-primary hover:text-amber-700  justify-between items-center cursor-pointer"
                                @click="selectVideo(video)">
                                <div class="w-60  " :class="{ 'text-amber-500 ': isVideoPlaying(video) }">
                                    {{ video.titre }}

                                </div>
                                <div class="text-sm" :class="{ 'text-amber-500': isVideoPlaying(video) }">
                                    {{ video.duree }}

                                </div>

                            </div>

                            <!-- <div v-for="video in module.videos" :key="video.id" class="ml-4 ">
                                <div>
                                    {{ video.titre }}
                                </div>
                                <div class="text-sm">
                                    {{ video.duree }}
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayoutEmploye>
</template>


<style scoped>
/* Ajoutez ici vos styles Tailwind personnalisés */
</style>
