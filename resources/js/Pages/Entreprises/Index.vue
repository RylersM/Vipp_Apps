<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Icon from '@/Components/Icons/Icon.vue';
import { router } from "@inertiajs/vue3";
import { ref } from 'vue';

let props = defineProps({
    entreprises: {
        type: Array,
        default: () => ({}),
    },
});

let entreprises = ref(props.entreprises);


const affectation = (user_id) => {
    router.get('/entreprise/affectation',
    {
        user_id : user_id
    }
    )
}
</script>
<template>
    <Head title="Liste des entreprises " />
    <AuthenticatedLayoutAdmin>
        <div class="px-10 py-5">

            <h1 class="text-2xl font-bold mb-4 text-center mt-10 text-slate-800">Liste des entreprises </h1>
            <div class="shadow mt-5">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="bg-[#0A2E5A] text-white uppercase  dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nom complet du Gérant
                                </th>

                                <th scope="col" class="px-6 py-3">
                                   Nom de l'entreprise
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Pays
                                </th>
                                <th scope="col" class="px-6 py-3">
                                   Téléphone
                                </th>
                                <th scope="col" class="px-6 py-3  text-center">
                                   Nombre d'utilisateurs requis
                                </th>


                                <th scope="col" class="px-6 py-3">
                                    <span class="flex justify-center">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="entreprise in entreprises" :key="entreprise.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ entreprise.name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ entreprise.enseigne }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ entreprise.pays }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ entreprise.telephone }}
                                </th>

                                <td class=" font-medium cursor-pointer px-6 py-3 text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ entreprise.nombre_utilisateurs_requis }}
                                </td>

                                <td class="">
                                    <div class="flex justify-center items-center gap-10 px-6 py-3 text-right">
                                        <a href="#"
                                            class="cursor-pointer font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Voir</a>

                                        <a @click="affectation(entreprise.id)"
                                            class="cursor-pointer font-medium text-slate-600 dark:text-slate-500 hover:underline">Affectations</a>

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

        </div>


    </AuthenticatedLayoutAdmin>
</template>


<style></style>
