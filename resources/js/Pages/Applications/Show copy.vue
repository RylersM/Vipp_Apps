<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Icon from '@/Components/Icons/Icon.vue';
import { router } from "@inertiajs/vue3";
import { ref } from 'vue';

let props = defineProps({
    application: {
        type: Array,
        default: () => ({}),
    },

    formation: {
        type: Array,
        default: () => ({}),
    },
    
    videoFormation: {
        type: Array,
        default: () => ({}),
    },
});

let application = ref(props.application);
let formation = ref(props.formation);
let videoFormation = ref(props.videoFormation);

console.log(application.value);
console.log(formation.value);
console.log(videoFormation.value);

const getVideoThumbnailUrl = (imageName) => {
    return '/storage/images/' + imageName;
}
const getVideoUrl = (videoName) => {
    return '/storage/videos/' + videoName;
}


const createFormation = (idApplication) => {
    router.post(route("formation.create", {
        id: idApplication,
    }));
};

const expandedVideo = ref(null);
const expandedVideoTitle = ref(null);

const expandVideo = (url, title) => {
    expandedVideo.value = url;
    expandedVideoTitle.value = title;

};

</script>
<template>
    <Head title="Admin Dashboard" />
    <AuthenticatedLayoutAdmin>


        <div class="flex">
            <div class="shadow-lg max-h-[35rem] rounded-sm">

                <h1 class=" font-bold text-xl flex justify-center">{{ expandedVideoTitle }}</h1>
                <!-- <div class="flex justify-end">
                            <span class="cursor-pointer" @click="expandedVideo = null">
                                <Icon name="closeBtn" />
                            </span>
                        </div> -->

                <iframe :src="expandedVideo" frameborder="0" allowfullscreen class="w-[60rem] h-[35rem]"></iframe>

            </div>

            <div>
                <div class="max-w-2xl  p-6">
                    <h1 class="text-3xl font-semibold mb-4">{{ formation ? formation.titre : '' }}</h1>


                    <p class="text-gray-600 mb-6">{{ formation ? formation.description : '' }}</p>

                </div>


                <div class="max-w-sm  px-6">


                    <h2 class="text-xl font-semibold mb-4">Vidéos de la Formation</h2>

                    <div class="overflow-y-scroll max-h-[36rem]  w-[40rem]">
                        <div v-for="video in videoFormation" :key="video.id"
                            class="cursor-pointer flex  justify-between  items-center bg-white p-4 rounded shadow-md mb-4 h-20"
                           >
                            <div  @click="expandVideo(video.url, video.titre)">
                                <p class="text-sm text-orange-800">Vidéo {{ video.ordre }}</p>
                                <p class="font-bold">{{ video.titre }}</p>
                                <p class="italic text-sm">{{ video.duree }}</p>

                            </div>
                            <div class="flex justify-between items-center ">

                                <div class="flex items-center gap-2">

                                    <p>Marquer comme lu</p>
                                    <input type="checkbox" name="" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex gap-5 mt-10">
            <PrimaryButton v-if="!formation" @click="createFormation(application.id)">
                Ajouter une formation
            </PrimaryButton>

            <PrimaryButton @click="createFormation(application.id)">
                Ajouter un module
            </PrimaryButton>

            <PrimaryButton @click="createFormation(application.id)">
                Ajouter une vidéos
            </PrimaryButton>

        </div>

    </AuthenticatedLayoutAdmin>
</template>


<style></style>
