<template>
    <AuthenticatedLayoutAdmin>

        <!-- <div class="flex container mx-auto"> -->
        <div class="">
            <h1 class="text-2xl font-bold mb-4 text-center mt-10">Affectation de Formations</h1>
            <div class="container mx-auto grid grid-cols-2 gap-5">
                <div class=" mb-20">
                    <!-- Tableau des Formations -->
                    <h1 class="text-xl">Formations</h1>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border">
                        <thead class="bg-[#0A2E5A] text-white uppercase  dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Formations
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    <span class="flex justify-center">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr v-for="formation in formations" :key="formation.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ formation.titre }}
                                </th>


                                <td class="">
                                    <div class="flex justify-center items-center gap-10 px-6 py-3 text-right">
                                        <a @click="affecterFormation(formation)"
                                            class="cursor-pointer font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Affecter</a>


                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div>

                    <!-- Tableau des Formations affectées -->
                    <h1 class="text-xl">Utilisateur</h1>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border">
                        <thead class="bg-[#0A2E5A] text-white uppercase  dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Formations
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    <span class="flex justify-center">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <template v-for="(user, index) in utilisateurs" :key="user.id">

                                <tr v-for="formation in user.formations" :key="formation.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ formation.titre }}
                                    </th>


                                    <td class="">
                                        <div class="flex justify-center items-center gap-10 px-6 py-3 text-right">
                                            <a @click="desaffecterFormation(index)"
                                                class="cursor-pointer font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Désaffecter</a>


                                        </div>
                                    </td>
                                </tr>
                            </template>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </AuthenticatedLayoutAdmin>
</template>

<script setup>
import { ref, reactive } from 'vue';
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';

let props = defineProps({
    formations: {
        type: Array,
        default: () => ({}),
    },

    utilisateursAvecFormations: {
        type: Array,
        default: () => ({}),
    },
});

console.log(props.utilisateursAvecFormations);

// Données de formations et utilisateurs
const formations = ref(props.formations);

const utilisateurs = reactive(props.utilisateursAvecFormations);

// Méthode pour affecter une formation à un utilisateur
const affecterFormation = (formation) => {
    const utilisateur = utilisateurs[0]; // Affecter à l'utilisateur 1 pour cet exemple

    // Vérifier si la formation n'est pas déjà affectée à l'utilisateur
    if (!utilisateur.formations.some((f) => f.id === formation.id)) {
        utilisateur.formations.push(formation);

        // Afficher l'ID de la formation et de l'utilisateur dans la console
        console.log(`Formation ID: ${formation.id}, Utilisateur ID: ${utilisateur.id}`);
    }
};

// Méthode pour désaffecter une formation d'un utilisateur
const desaffecterFormation = (userIndex) => {
    utilisateurs[userIndex].formations.pop();
};
</script>
