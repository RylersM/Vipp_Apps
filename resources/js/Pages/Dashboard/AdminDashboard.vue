<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';
import Icon from '@/Components/Icons/Icon.vue';
import { ref } from 'vue';

let props = defineProps({
    applications: {
        type: Array,
        default: () => ({}),
    },

    formations: {
        type: Array,
        default: () => ({}),
    },

    entreprises: {
        type: Array,
        default: () => ({}),
    },

    users: {
        type: Array,
        default: () => ({}),
    },
});

let applications = ref(props.applications);
let formations = ref(props.entreprises);
let entreprises = ref(props.applications);
let users = ref(props.entreprises);

console.log(applications.value);
</script>
<template>
    <Head title="Admin Dashboard" />
    <AuthenticatedLayoutAdmin>
        <div class="px-10 py-5 mt-2 ">


            <!-- Contenu principal -->

            <!-- Titre de la section -->
            <h1 class="text-2xl font-semibold mb-4">Tableau de Bord de l'Administrateur</h1>
            <h2 class="text-xl font-semibold mb-4 text-slate-500">Bonjour, {{ $page.props.auth.user.name }} !</h2>

            <!-- Section Statistiques -->
            <section class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-4">Statistiques Générales</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Statistique 1 -->
                    <div class="p-4 bg-blue-100 rounded-lg shadow-md">
                        <p class="text-5xl font-bold ">{{ applications.length < 10 ? '0' + applications.length :
                            applications.length }}</p>
                                <p class="text-gray-600 text-2xl">Applications</p>
                    </div>
                    <!-- Statistique 2 -->
                    <div class="p-4 bg-yellow-100 rounded-lg shadow-md">
                        <p class="text-5xl font-bold ">{{ formations.length < 10 ? '0' + formations.length :
                            formations.length }}</p>
                                <p class="text-gray-600 text-2xl">Formations</p>
                    </div>
                    <!-- Statistique 3 -->
                    <div class="p-4 bg-green-100 rounded-lg shadow-md">
                        <p class="text-5xl font-bold ">{{ entreprises.length < 10 ? '0' + entreprises.length :
                            entreprises.length }}</p>
                                <p class="text-gray-600 text-2xl">Entreprises</p>
                    </div>
                    <!-- Statistique 4 -->
                    <div class="p-4 bg-red-100 rounded-lg shadow-md">
                        <p class="text-5xl font-bold ">{{ users.length < 10 ? '0' + users.length : users.length }}</p>
                                <p class="text-gray-600 text-2xl">Utilisateurs</p>
                    </div>
                    <!-- Statistique 5
                    <div class="p-4 bg-slate-100 rounded-lg shadow-md">
                        <p class="text-5xl font-bold ">82%</p>
                        <p class="text-gray-600 text-2xl">Taux de Réussite</p>
                    </div> -->
                </div>
            </section>

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


    </AuthenticatedLayoutAdmin>
</template>

