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
            <h1 class="text-2xl font-bold mb-4 text-center mt-10 text-slate-800">Affectation d'une applications à une
                entreprise</h1>
            <div class="container mx-auto grid grid-cols-2 gap-5">
                <div class=" mb-20">
                    <!-- Tableau des applications -->
                    <h1 class="text-xl">Applications</h1>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border">
                        <thead class="bg-[#0A2E5A] text-white uppercase  dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Applications
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    <span class="flex justify-center">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr v-for="application in applications" :key="application.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ application.nom }}
                                </th>


                                <td class="">
                                    <div class="flex justify-center items-center gap-10 px-6 py-3 text-right">
                                        <a @click="affecterApplication(application)"
                                            class="cursor-pointer font-medium text-green-600 dark:text-green-500 hover:underline">Affecter</a>


                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div>

                    <!-- Tableau des applications affectées -->
                    <h1 class="text-xl text-green-900">Enseigne : <span class="italic font-bold">{{ utilisateurs.enseigne
                    }}</span></h1>

                    <table class=" relative w-full text-sm text-left text-gray-500 dark:text-gray-400 border">
                        <thead class="bg-[#0A2E5A] text-white uppercase  dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    applications affectées
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    <span class="flex justify-center">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>



                            <tr v-for="application in utilisateurs.applications" :key="application.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ application.nom }}
                                </th>


                                <td class="">
                                    <div class="flex justify-center items-center gap-10 px-6 py-3 text-right">
                                        <a @click="desaffecterApplication(application.id)"
                                            class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline">Désaffecter</a>


                                    </div>
                                </td>
                            </tr>
                            <tr class="text-center absolute inset-1 flex items-center justify-center mt-[8rem]"
                                scope="colspan" v-if="utilisateurs.applications.length === 0">
                                Aucune application affectées
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
    applications: {
        type: Array,
        default: () => ({}),
    },

    utilisateurAvecApplications: {
        type: Array,
        default: () => ({}),
    },
});


// Données de applications
let applications = ref(props.applications);

// Données de l'utilisateur avec les applications qui lui sont affectée
let utilisateurs = reactive(props.utilisateurAvecApplications);


let successMessage = ref("");
let errorMessage = ref("");

// Méthode pour affecter une application à un utilisateur
const affecterApplication = (application) => {

    // Fontion permettant d'effectuer l'affectation d'une application à un utilisateur
    axios.post('/affectationApplicationUser', {
        user_id: utilisateurs.id,
        application_id: application.id
    }).then(response => {
        axios.post('/getUserApplicationsDatas', {
            user_id: utilisateurs.id,
        }).then(response => {
            applications.value = response.data.applications;
            utilisateurs = response.data.utilisateurAvecApplications;

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

// Méthode pour désaffecter une application d'un utilisateur
const desaffecterApplication = async (application_id) => {


    // Fontion permettant d'effectuer l'affectation d'une application à un utilisateur
    await axios.post('/desaffectationApplicationUser', {
        user_id: utilisateurs.id,
        application_id: application_id
    }).then(response => {

        axios.post('/getUserApplicationsDatas', {
            user_id: utilisateurs.id,
        }).then(response => {
            applications.value = response.data.applications;
            utilisateurs = response.data.utilisateurAvecApplications;


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

const getUserApplicationsDatas = () => {
    axios.post('/getUserApplicationsDatas', {
        user_id: utilisateurs.id,
    }).then(response => {
        applications.value = response.data.applications;
        utilisateurs.value = response.data.utilisateurAvecApplications;
    })
}
</script>
