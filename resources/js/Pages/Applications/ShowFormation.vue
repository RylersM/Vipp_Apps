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
        default: () => [],
    },

    formations: {
        type: Object,
        default: () => ({}),
    },

    backUrl: {
        type: String,
        default: '',
    },

});

let application = ref(props.application);
let formations = ref(props.formations);

console.log(application.value);
console.log(formations.value);


axios.post('/getformation', {
    idapplication: props.application.id,
}).then(response => {
    formations.value = response.data.formations;
    console.log(formations.value);
})


let nomFormation = ref('');
let descriptionFormation = ref('');
let successMessage = ref('');
let errorMessage = ref('');

const createFormation = () => {
    axios
        .post(route('formation.store', {
            idapplication: props.application.id,
            titre: nomFormation.value,
            description: descriptionFormation.value,
        }))
        .then(response => {

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

            axios.post('/getformation', {
                idapplication: props.application.id,
            }).then(response => {
                formations.value = response.data.formations;
                console.log(formations.value);
            })

            nomFormation.value = '';
            descriptionFormation.value = '';
            fermerModal();
        })
        .catch(error => {
            console.error('Erreur lors de la création de la formation', error);
        });


};

let modalVisible = ref('');
const ouvrirModal = () => {
    modalVisible.value = true;
};

const fermerModal = () => {
    modalVisible.value = false;
};

const showformation = (id_formation) => {
    console.log(id_formation);

    router.get('/formation/show', {
        application_id: props.application.id,
        id: id_formation,
        backUrl: window.location.href,
    }, {
        preserveState: true,
        replace: true
    });
}


// Fonction permettant d'aller à la page précedente
const pagePrécedente = () => {
    // Rediriger l'utilisateur vers l'URL précédente
    window.location.href = props.backUrl;
}

// Function qui permet de supprimer un utilisateur
// function deleteUser(user, id) {
//   if (confirm(`Voulez vous supprimer ${user} ?`)) {
//     Inertia.delete(route("user.destroy", id));
//   }
// }

// Fonction qui affiches la page d'edition d'un utilisateur.
// const editUser = (id) => {
//   router.get(route("user.edit", id));
// };

</script>
<template>
    <Head title="Formations" />
    <AuthenticatedLayoutAdmin>
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

        <div class="text-start text-sm text-red-900 font-semibold  font-mono mt-2">
            # {{ props.application.nom }}
        </div>

        <div class="flex justify-between gap-5 mt-2">
            <PrimaryButton @click="ouvrirModal">
                Ajouter une formation
            </PrimaryButton>
            <PrimaryButton class="flex gap-1 items-center justify-center" @click="pagePrécedente()">
                <span>Retour</span>
                <Icon name="back" />
            </PrimaryButton>
        </div>


        <div class="shadow mt-5">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Titre de la formation
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>


                            <th scope="col" class="px-6 py-3">
                                <span class="flex justify-center">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="formation in formations" :key="formation.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th @click="showformation(formation.id)" scope="row"
                                class="px-6 py-4 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                {{ formation.titre }}
                            </th>

                            <td @click="showformation(formation.id)" class=" cursor-pointer px-6 py-4 ">
                                {{ formation.description }}
                            </td>

                            <td class="">
                               <div class="flex justify-center items-center gap-10 px-6 py-4 text-right">
                                <a href="#"
                                    class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">Voir</a>
                                <a href="#"
                                    class="cursor-pointer font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</a>

                                <a href="#"
                                    class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
                               </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>



        <div v-if="modalVisible == true"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 ">

            <div v-if="modalVisible == true" class=" relative bg-white  p-8 rounded-lg shadow-lg">


                <span @click="fermerModal" class="absolute top-2 right-2 ">
                    <Icon name="closeBtn" />
                </span>

                <div class="flex flex-col justify-between">
                    <h1 class=" text-xl font-bold mb-10">Créer une formation sur l'application {{ application.nom }}</h1>

                    <div>
                        <div class="mb-4">
                            <label for="nomFormation" >Nom de la formation</label>

                            <input type="text" id="nomFormation"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                             required v-model="nomFormation">
                        </div>

                        <div class="mb-4">
                            <label for="descriptionFormation" >Description de la formation</label>
                            <textarea id="descriptionFormation" type="text"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                v-model="descriptionFormation" required autocomplete="groupe"></textarea>
                        </div>
                    </div>

                    <button @click="createFormation"
                        class="border h-10 rounded-lg justify-center flex items-center bg-yellow-600 text-white px-5 mb-3">
                        Créer
                    </button>
                </div>
            </div>

        </div>

    </AuthenticatedLayoutAdmin>
</template>


<style></style>
