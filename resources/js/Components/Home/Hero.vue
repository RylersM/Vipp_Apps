<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3'
import Icon from '@/Components/Icons/Icon.vue'

const showContent = ref(false);

onMounted(() => {
    // Ajoute la classe "slide-in" après un court délai pour permettre le rendu initial
    setTimeout(() => {
        showContent.value = true;
    }, 100);
});

const about = () => {
    // router.get('/about')
    window.location.href = '/about'
}



const videoOpen = ref(false);
const videoSrc = ref('https://www.youtube.com/embed/rFVpSwgCkCo?autoplay=1');

function closeVideo() {
    videoOpen.value = false;
    videoSrc.value = '';
}

</script>
<template>
    <!-- ====== Hero Section Start -->
    <div class="py-[5rem]  pb-10 bg-gradient-to-b from-[#0054bb] to-[#0A2E5A] shadow-xl">
        <div class="container mx-auto px-5 md:px-0">
            <div class="-mx-4 flex flex-wrap">
                <div class="w-full px-4 lg:w-5/12">
                    <div class="hero-content slideleft" :class="{ 'slide-in': showContent }">
                        <h1
                            class="text-dark   mb-3 text-4xl font-bold text-white leading-snug sm:text-[42px] lg:text-[40px] xl:text-[48px]">
                            Vipp Apps est une suite d'applications innovantes développée par l'Université Highfive, sous la
                            couverture de la
                            société <a href="https://www.vippglitter.com/" class="text-yellow-500">GLITTER</a>.


                        </h1>
                        <p class="text-body-color mb-8 max-w-[480px] text-white text-2xl">
                            Cette plateforme a été conçue pour répondre aux besoins des entreprises qui souhaitent former
                            leurs employés afin d'optimiser leur utilisation professionnelle.
                        </p>


                        <PrimaryButton @click="about">
                            En savoir plus
                        </PrimaryButton>

                    </div>
                </div>


                <div class="hidden px-4 lg:block lg:w-1/12 "></div>
                <div class="w-full px-4 lg:w-6/12">

                    <iframe  class="h-[450px] w-full rounded-xl" :src="videoSrc" frameborder="0" allowfullscreen autoplay> </iframe>
                </div>

            </div>
        </div>
    </div>
    <!-- ====== Hero Section End -->
</template>


<style scope>
.slideleft {
    transform: translateX(-22%);
    transition: transform 2s ease;
}

.slideright {
    transform: translateX(22%);
    transition: transform 2s ease;
}

.slide-in {
    transform: translateX(0%);
    transition: transform 2s ease;
}
</style>
