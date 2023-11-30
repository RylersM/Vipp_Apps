<template>
    <AuthenticatedLayoutAdmin>

        <Head title="Affectation " />

        <!-- Block de code permettant d'afficher les message flash-->
        <div v-if="successMessage"
            class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-primary absolute top-[5rem] right-[1rem] left-[17rem]"
            role="alert">
            <span class="sr-only">Info</span>
            <Icon name="exclam" />
            <div>
                <span class="font-medium">{{ successMessage }}</span>
            </div>
        </div>
        <div v-if="errorMessage"
            class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 absolute top-[5rem] right-[2rem] left-[18rem]"
            role="alert">
            <span class="sr-only">Info</span>
            <Icon name="exclam" />
            <div>
                <span class="font-medium">{{ errorMessage }}</span>
            </div>
        </div>

        <!-- <div class="flex container mx-auto"> -->
        <div class="">
            <h1 class="text-2xl font-bold mb-4 text-center mt-10 text-slate-800">Affectation de Formations à un utilisateur
            </h1>
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
                                            class="cursor-pointer font-medium text-green-600 dark:text-green-500 hover:underline">Affecter</a>


                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div>

                    <!-- Tableau des Formations affectées -->
                    <h1 class="text-xl text-green-900">Nom complet : <span class="italic font-bold">{{ utilisateurs.name
                    }}</span></h1>

                    <table class=" relative w-full text-sm text-left text-gray-500 dark:text-gray-400 border">
                        <thead class="bg-[#0A2E5A] text-white uppercase  dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Formations affectées
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    <span class="flex justify-center">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>



                            <tr v-for="formation in utilisateurs.formations" :key="formation.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ formation.titre }}
                                </th>


                                <td class="">
                                    <div class="flex justify-center items-center gap-10 px-6 py-3 text-right">
                                        <a @click="desaffecterFormation(formation.id)"
                                            class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline">Désaffecter</a>


                                    </div>
                                </td>
                            </tr>
                            <tr class="text-center absolute inset-1 flex items-center justify-center mt-[8rem]"
                                scope="colspan" v-if="utilisateurs.formations.length === 0">
                                Aucune formation affectées
                            </tr>


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
import { Head } from '@inertiajs/vue3';

let props = defineProps({
    formations: {
        type: Array,
        default: () => ({}),
    },

    utilisateurAvecFormations: {
        type: Array,
        default: () => ({}),
    },
});


// Données de formations
let formations = ref(props.formations);

// Données de l'utilisateur avec les formations qui lui sont affectée
let utilisateurs = reactive(props.utilisateurAvecFormations);


let successMessage = ref("");
let errorMessage = ref("");
// Méthode pour affecter une formation à un utilisateur
const affecterFormation = (formation) => {

    // Fontion permettant d'effectuer l'affectation d'une formation à un utilisateur
    axios.post('/affectationFormationUser', {
        user_id: utilisateurs.id,
        formation_id: formation.id
    }).then(response => {
        axios.post('/getUserFormationsDatas', {
            user_id: utilisateurs.id,
        }).then(response => {
            formations.value = response.data.formations;
            utilisateurs = response.data.utilisateurAvecFormations;
        })
        // Traitement des réponses ici
        successMessage.value = response.data.successMessage;
        errorMessage.value = response.data.errorMessage;

        // Effacement du message de notification après quelques secondes
        if (successMessage.value) {
            setTimeout(() => {
                successMessage.value = "";
            }, 3000);
        }
        // Effacement du message de notification après quelques secondes
        if (errorMessage.value) {
            setTimeout(() => {
                errorMessage.value = "";
            }, 3000);
        }
    })
};

// Méthode pour désaffecter une formation d'un utilisateur
const desaffecterFormation = async (formation_id) => {

    // Fontion permettant d'effectuer l'affectation d'une formation à un utilisateur
    await axios.post('/desaffectationFormationUser', {
        user_id: utilisateurs.id,
        formation_id: formation_id
    }).then(response => {

        axios.post('/getUserFormationsDatas', {
            user_id: utilisateurs.id,
        }).then(response => {
            formations.value = response.data.formations;
            utilisateurs = response.data.utilisateurAvecFormations;
        })
        // Traitement des réponses ici
        successMessage.value = response.data.successMessage;
        errorMessage.value = response.data.errorMessage;

        // Effacement du message de notification après quelques secondes
        if (successMessage.value) {
            setTimeout(() => {
                successMessage.value = "";
            }, 3000);
        }
        // Effacement du message de notification après quelques secondes
        if (errorMessage.value) {
            setTimeout(() => {
                errorMessage.value = "";
            }, 3000);
        }
    })
};

const getUserFormationsDatas = () => {
    axios.post('/getUserFormationsDatas', {
        user_id: utilisateurs.id,
    }).then(response => {
        formations.value = response.data.formations;
        utilisateurs.value = response.data.utilisateurAvecFormations;
    })
}
</script>
