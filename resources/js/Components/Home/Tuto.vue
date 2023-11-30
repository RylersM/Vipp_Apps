<template>
    <!-- ====== Video Section Start -->
    <section class="relative z-10 overflow-hidden ">
        <div class="container mx-auto z-50 px-5">
            <div class="-mx-4 flex flex-wrap">
                <div class="w-full px-4 lg:w-1/2">
                    <div class="max-w-[490px] py-[100px] lg:py-[140px]">
                        <h2 class="text-dark mb-8 text-3xl font-bold sm:text-4xl">
                            Explorez une multitude d'applications conçues pour améliorer votre quotidien.
                        </h2>
                        <p class="text-body-color mb-4 text-base">
                            Nous offrons la possibilité aux entreprises de former leurs employés de manière personnalisée
                            sur nos applications. Cela permet de maximiser l'utilisation des outils et d'accroître
                            l'efficacité au sein de l'organisation.
                        </p>
                        <p class="text-body-color mb-12 text-base">
                            Rejoignez notre communauté grandissante d'utilisateurs satisfaits et découvrez les dernières
                            tendances en
                            matière d'applications web. Avec notre store, accédez à un éventail d'options variées et trouvez
                            celles qui
                            correspondent parfaitement à vos besoins.
                        </p>

                        <a href="/catalogue"
                            class="bg-secondary inline-flex items-center justify-center rounded-full py-2 px-10 text-center text-base font-normal text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                            Explorer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="top-0 right-0 z-50 h-full w-full lg:absolute lg:w-1/2">
                <div class="flex h-full w-full items-center justify-center">
                    <img :src="'/images/log.png'" alt="image"
                        class="top-0 left-0 z-[-1] h-full w-full object-cover object-center lg:absolute" />

                </div>
            </div>

            <span class="absolute left-0 top-0 z-[-1]">
                <svg width="644" height="489" viewBox="0 0 644 489" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="196" cy="41" r="448" fill="#0054bb" fill-opacity="0.04" />
                </svg>
            </span>
            <span class="absolute left-0 top-0 z-[-1]">
                <svg width="659" height="562" viewBox="0 0 659 562" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="211" cy="114" r="448" fill="#0054bb" fill-opacity="0.04" />
                </svg>
            </span>
            <span class="absolute right-3 top-3 z-[-1] lg:right-1/2 lg:mr-3">
                <Icon name="dots" />
            </span>
        </div>


    </section>
    <!-- ====== Video Section End -->
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Icons/Icon.vue'

const videoOpen = ref(false);
const videoSrc = ref('');

function closeVideo() {
    videoOpen.value = false;
    videoSrc.value = '';
}
</script>

<style></style>
