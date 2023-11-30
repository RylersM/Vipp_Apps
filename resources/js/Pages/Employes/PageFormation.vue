<script setup>
import AuthenticatedLayoutEmploye from '@/Layouts/AuthenticatedLayoutEmploye.vue';
import { Head } from '@inertiajs/vue3';
import Icon from '@/Components/Icons/Icon.vue';
import { router } from "@inertiajs/vue3";
import { ref } from 'vue';

let props = defineProps({
    utilisateurAvecFormations: {
        type: Array,
        default: () => ({}),
    },
});

let utilisateurAvecFormations = ref(props.utilisateurAvecFormations);
console.log(utilisateurAvecFormations.value);

const startFormation = (id_formation) => {
    router.get('/employe/showformation', {

        id_formation: id_formation,

    }, {
        preserveState: true,
        replace: true
    });
}

</script>
<template>
    <Head title="Formations" />
    <AuthenticatedLayoutEmploye>

        <main class="container mx-auto my-8 h-screen">
            <h2 class="text-2xl font-semibold mb-8 text-slate-800">Découvrez nos formations auquelles vous avez accès
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 ">
                <!-- Exemple de carte de formation -->
                <!-- <div v-for="formation, index in utilisateurAvecFormations.formations" :key="index" class="relative h-[25rem] w-96 bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="https://via.placeholder.com/300x200" alt="Formation 1"
                            class="w-full h-56 object-cover object-center">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Formation Web Design {{ formation }}</h3>
                            <p class="text-gray-600 mb-4">Apprenez à concevoir des sites web exceptionnels.</p>
                            <div class=" flex justify-between items-center">
                                <p class="text-lg font-bold text-blue-600">$299</p>
                                <button
                                    class="absolute bottom-5 right-5 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Commenrcer</button>
                            </div>
                        </div>
                    </div> -->

                <div class="box" v-for="formation, index in utilisateurAvecFormations.formations" :key="index">
                    <span></span>
                    <div class="content">
                        <h2>{{ formation.titre }}</h2>
                        <p>{{ formation.description }}</p>
                        <a @click="startFormation(formation.id)">Commencer</a>
                    </div>
                </div>

            </div>

            <div v-if="utilisateurAvecFormations.formations.length === 0" class="w-full text-center text-xl text-slate-700">
                Aucune formation disponible pour le moment.
            </div>
        </main>

    </AuthenticatedLayoutEmploye>
</template>


<style scope>
.box {
    position: relative;
    width: 420px;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 40px 30px;
    transition: 0.5s;
}

.box::before {
    content: ' ';
    position: absolute;
    top: 0;
    left: 50px;
    width: 50%;
    height: 100%;
    text-decoration: none;
    background: #fff;
    border-radius: 8px;
    transform: skewX(15deg);
    transition: 0.5s;
}

.box::after {
    content: '';
    position: absolute;
    top: 0;
    left: 50;
    width: 50%;
    height: 100%;
    background: #fff;
    border-radius: 8px;
    transform: skewX(15deg);
    transition: 0.5s;
    /* filter: blur(10px); */
}

.box:hover:before,
.box:hover:after {
    transform: skewX(0deg);
    left: 20px;
    width: calc(100% - 90px);

}

.box::before,
.box::after {
    background: linear-gradient(315deg, #03a9f4, #ff0058)
}



.box span {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 5;
    pointer-events: none;
}

.box span::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 0;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    /* backdrop-filter: blur(10px); */
    opacity: 0;
    transition: 0.1s;
    animation: animate 2s ease-in-out infinite;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08)
}

.box:hover span::before {
    top: -50px;
    left: 50px;
    width: 100px;
    height: 100px;
    opacity: 1;
}

.box span::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    /* backdrop-filter: blur(10px); */
    opacity: 0;
    transition: 0.5s;
    animation: animate 2s ease-in-out infinite;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    animation-delay: -1s;
}

.box:hover span:after {
    bottom: -50px;
    right: 50px;
    width: 100px;
    height: 100px;
    opacity: 1;
}

@keyframes animate {

    0%,
    100% {
        transform: translateY(10px);
    }

    50% {
        transform: translate(-10px);
    }
}

.box .content {
    position: relative;
    width: 350px;
    left: 0;
    padding: 20px 40px;
    background: rgba(255, 255, 255, 0.05);
    /* backdrop-filter: blur(10px); */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    z-index: 1;
    transform: 0.5s;
    color: #0A2E5A;
    background: #fff;
}

.box:hover .content {
    left: -25px;
    padding: 60px 40px;
}

.box .content h2 {
    font-size: 2em;
    color: #0A2E5A;
    margin-bottom: 10px;
}

.box .content p {
    font-size: 1.1em;
    margin-bottom: 10px;
    line-height: 1.4em;
}

.box .content a {
    display: inline-block;
    padding: 10px 20px;
    background: linear-gradient(45deg, #ff4c4c, #ffafaf);
    color: #fff;
    text-decoration: none;
    border: 1px solid rgba(0, 0, 0, 0.2);
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease, border 0.3s ease, box-shadow 0.3s ease;
}

.box .content a:hover {
    background: linear-gradient(45deg, #ffa94c, #ffdbaf);
    border: 1px solid rgba(255, 0, 88, 0.4);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
}
</style>
