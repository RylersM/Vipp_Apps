<script setup>
import AuthenticatedLayoutEmploye from '@/Layouts/AuthenticatedLayoutEmploye.vue';
import { Head } from '@inertiajs/vue3';
import Icon from '@/Components/Icons/Icon.vue';
import { ref } from 'vue';

let props = defineProps({
    utilisateurAvecFormations: {
        type: Array,
        default: () => ({}),
    },
});

let utilisateurAvecFormations = ref(props.utilisateurAvecFormations);
console.log(utilisateurAvecFormations.value);

</script>
<template>
    <Head title="Admin Dashboard" />
    <AuthenticatedLayoutEmploye>
        <div class="px-10 py-5">
            <!-- En-tête -->
            <header class="bg-white p-4 shadow-md">
                <div class="container mx-auto">
                    <h1 class="text-2xl font-semibold">Tableau de bord </h1>
                    <p class="text-gray-600">Bienvenue, {{ props.utilisateurAvecFormations.name }} !</p>
                </div>
            </header>
            <div class="bg-white p-4 mt-5 shadow-md rounded-lg">
                <!-- Contenu principal -->

                <h2 class="text-2xl font-semibold mb-4 ">Statistiques</h2>
                <!-- Statistiques des employés -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Statistique des formations terminées -->
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-2 ">Formations Terminées</h3>
                        <p class="text-gray-600">Nombre total de formations complétées.</p>
                        <p class="text-blue-600 font-semibold mt-2 text-5xl">08</p>
                    </div>

                    <!-- Statistique de la progression moyenne -->
                    <div class="bg-green-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-2 ">Progression Moyenne</h3>
                        <p class="text-gray-600">Progression moyenne dans toutes les formations.</p>
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between text-xs">
                                <div><span class="font-semibold inline-block text-green-600 text-5xl">82%</span></div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                                <div style="width:82%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistique des badges obtenus -->
                    <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-2xl font-semibold mb-2 ">Badges Obtenus</h3>
                        <p class="text-gray-600">Nombre de badges obtenus.</p>
                        <p class="text-yellow-600 font-semibold mt-2 text-5xl">03</p>
                    </div>
                </div>
            </div>



            <div class="flex  gap-5">
                <div class=" w-1/2 bg-white p-4 mt-5 shadow-md rounded-lg">
                    <h2 class="text-2xl font-semibold mb-4">Formations en Cours</h2>
                    <!-- Liste des formations en cours -->
                    <ul class="divide-y divide-gray-300 rounded-lg shadow-l gp-4">
                        <li class="py-2">
                            <p class="text-gray-600">Nom de la Formation 1</p>
                            <div class="flex items-center justify-between mt-1">
                                <div class="relative pt-1 w-1/2">
                                    <div class="flex mb-2 items-center justify-between text-xs">
                                        <div><span class="font-semibold inline-block text-blue-600">40%</span></div>
                                    </div>
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                                        <div style="width:40%"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <p class="text-gray-600">Nom de la Formation 2</p>
                            <div class="flex items-center justify-between mt-1">
                                <div class="relative pt-1 w-1/2">
                                    <div class="flex mb-2 items-center justify-between text-xs">
                                        <div><span class="font-semibold inline-block text-green-600">75%</span></div>
                                    </div>
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                                        <div style="width:75%"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="py-2">
                            <p class="text-gray-600">Nom de la Formation 3</p>
                            <div class="flex items-center justify-between mt-1">
                                <div class="relative pt-1 w-1/2">
                                    <div class="flex mb-2 items-center justify-between text-xs">
                                        <div><span class="font-semibold inline-block text-yellow-600">50%</span></div>
                                    </div>
                                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-yellow-200">
                                        <div style="width:50%"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-yellow-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>


                <div class="w-1/2 bg-white p-4 mt-5 shadow-md rounded-lg">
                    <!-- Notification -->
                    <h2 class="text-2xl font-semibold mb-4">Notifications</h2>
                    <!-- Liste des notifications -->
                    <ul class="divide-y divide-gray-300">
                        <!-- Notification 1 -->
                        <li class="py-2">
                            <div class="bg-blue-200 p-4 rounded-lg shadow-md flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 6v-2m0 0c3.866 0 7-2.239 7-5s-3.134-5-7-5-7 2.239-7 5 3.134 5 7 5z">
                                        </path>
                                    </svg>
                                    <p class="text-blue-800">Vous avez une nouvelle notification. Cliquez pour en savoir
                                        plus.</p>
                                </div>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </li>

                        <!-- Notification 2 -->
                        <li class="py-2">
                            <div class="bg-green-200 p-4 rounded-lg shadow-md flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="h-6 w-6 text-green-600 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 6v-2m0 0c3.866 0 7-2.239 7-5s-3.134-5-7-5-7 2.239-7 5 3.134 5 7 5z">
                                        </path>
                                    </svg>
                                    <p class="text-green-800">Une nouvelle formation est disponible. Inscrivez-vous
                                        maintenant.</p>
                                </div>
                                <button class="text-gray-500 hover:text-gray-700">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </li>

                        <!-- Ajoutez d'autres notifications ici -->

                    </ul>
                </div>
            </div>


        </div>



    </AuthenticatedLayoutEmploye>
</template>


<style></style>
