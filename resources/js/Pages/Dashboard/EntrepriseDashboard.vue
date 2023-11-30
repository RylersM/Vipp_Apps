<script setup>
import AuthenticatedLayoutEntreprise from '@/Layouts/AuthenticatedLayoutEntreprise.vue';
import { Head } from '@inertiajs/vue3';
import Icon from '@/Components/Icons/Icon.vue';
import { ref } from 'vue';

let props = defineProps({
    applications: {
        type: Array,
        default: () => ({}),
    },
});

let applications = ref(props.applications);
console.log(applications.value);

</script>
<template>
    <Head title="Entreprise Dashboard" />
    <AuthenticatedLayoutEntreprise>
        <div class="px-10 py-5" >
            <!-- En-tête -->
            <header class="bg-white p-4 shadow-md">
                <div class="container mx-auto">
                    <h1 class="text-2xl font-semibold">Tableau de bord de l'entreprise <span class="text-amber-600">{{
                        $page.props.auth.user.enseigne }}</span></h1>
                    <p class="text-gray-600">Bienvenue, {{ $page.props.auth.user.name }}</p>
                </div>
            </header>

            <!-- Contenu principal -->



                <div class=" mt-6 p-4 col-span-9 bg-white  rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">Statistiques</h2>

                    <!-- Statistiques des employés -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Statistique des applications -->
                        <div class="bg-green-100 p-4 rounded-lg shadow-md">
                            <h3 class="font-semibold mb-2 text-2xl">Applications disponibles</h3>
                            <p class="text-gray-600">Nombre total d'applications disponibles.</p>
                            <p class="text-green-800 font-bold mt-2 text-5xl">15</p>
                        </div>

                        <!-- Statistique des formations -->
                        <div class="bg-red-100 p-4 rounded-lg shadow-md">
                            <h3 class="font-semibold mb-2 text-2xl">Formations disponibles</h3>
                            <p class="text-gray-600">Nombre total des formations disponibles.</p>
                            <p class="text-red-600 mt-2 font-bold text-5xl">20</p>
                        </div>

                        <!-- Statistique des employés actifs -->
                        <div class="bg-blue-100 p-4 rounded-lg shadow-md">
                            <h3 class="font-semibold mb-2 text-2xl">Utilisateurs</h3>
                            <p class="text-gray-600">Nombre total d'utilisateurs.</p>
                            <p class="text-blue-600 mt-2 font-bold  text-5xl">03</p>
                        </div>


                        <!-- Progression de la formation -->
                        <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
                            <h3 class="font-semibold mb-2 text-2xl">Progression </h3>
                            <p class="text-gray-600">Progression moyenne des utilisateurs.</p>
                            <p class="text-yellow-600 font-bold mt-2  text-5xl">75%</p>
                        </div>
                    </div>

                </div>

                <div class="flex  gap-5">
                    <div class="mt-6 p-4 w-1/2 col-span-9 bg-white  rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold mb-4">Utilisateurs Connectés</h2>
                        <ul class="  flex flex-col gap-1">
                            <!-- Utilisateur 1 -->
                            <li
                                class="bg-gray-100 hover:bg-green-50 px-4 py-2 rounded-lg shadow-md flex  justify-between items-center ">
                                <h2 class=" font-semibold">Johanne Viloux</h2>
                                <h3 class=" font-light italic text-slate-500">Progression 65% </h3>
                                <p class="text-green-800 font-bold">En ligne</p>
                            </li>
                            <li
                                class="bg-gray-100 hover:bg-green-50 px-4 py-2 rounded-lg shadow-md flex  justify-between items-center ">
                                <h2 class=" font-semibold">Cloé Arakmach</h2>
                                <h3 class=" font-light italic text-slate-500">Progression 35% </h3>
                                <p class="text-green-800 font-bold">En ligne</p>
                            </li>
                            <li
                                class="bg-gray-100 hover:bg-green-50 px-4 py-2 rounded-lg shadow-md flex  justify-between items-center ">
                                <h2 class=" font-semibold">Padina Vogue</h2>
                                <h3 class=" font-light italic text-slate-500">Progression 80% </h3>
                                <p class="text-green-800 font-bold">En ligne</p>
                            </li>




                            <!-- Vous pouvez ajouter plus d'utilisateurs ici en suivant le même modèle -->
                        </ul>
                    </div>

                    <!-- Zone de contenu principal -->
                    <div class="mt-6 p-4 w-1/2 col-span-9 bg-white  rounded-lg shadow-md">

                        <!-- Section d'avis et de commentaires -->
                        <h2 class="text-2xl font-semibold ">Avis et Commentaires</h2>

                        <!-- Liste des avis -->
                        <ul>
                            <!-- Avis 1 -->
                            <li class="mb-4">
                                <div class=" p-4 rounded-lg shadow-md">
                                    <p class="text-blue-800">Formation très informative et utile.</p>
                                    <p class="text-gray-600">- Soraya Dallo</p>
                                    <p class="text-gray-600 cursor-pointer">Répondre</p>
                                </div>
                            </li>

                            <!-- Avis 2 -->
                            <li class="mb-4">
                                <div class=" p-4 rounded-lg shadow-md">
                                    <p class="text-green-800">J'ai adoré cette formation. Merci!</p>
                                    <p class="text-gray-600">- Page Klach</p>
                                    <p class="text-gray-600 cursor-pointer">Répondre</p>
                                </div>
                            </li>

                            <!-- Ajoutez d'autres avis ici -->
                        </ul>

                        <!-- Formulaire de commentaire -->
                        <form class="mt-6">
                            <textarea class="w-full p-2 rounded-lg shadow-md" rows="4"
                                placeholder="Laissez votre commentaire ici..."></textarea>
                            <button
                                class="mt-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                                Soumettre
                            </button>
                        </form>

                    </div>
                </div>


        </div>


    </AuthenticatedLayoutEntreprise>
</template>


<style></style>
