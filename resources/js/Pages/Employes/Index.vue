<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Icon from '@/Components/Icons/Icon.vue';
import { router } from "@inertiajs/vue3";
import { ref } from 'vue';

let props = defineProps({
    employes: {
        type: Array,
        default: () => ({}),
    },
});

let employes = ref(props.employes);


const affectation = (user_id) => {

    router.get('/employe/affectation', {
        user_id: user_id
    }, {
        preserveState: true,
        replace: true
    });
}

const createUser = () => {

    router.get('/utilisateurs/create'
    );
}

</script>
<template>

    <Head title="Liste des employes " />
    <AuthenticatedLayoutAdmin>
        <div class="px-10 py-5">
            <div>
                <PrimaryButton @click="createUser">
                    Ajouter un nouvel utilisateur
                </PrimaryButton>
            </div>
            <h1 class="text-2xl font-bold mb-4 text-center mt-10 text-slate-800">Liste des utilisateurs </h1>
            <div class="shadow mt-5">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="bg-[#0A2E5A] text-white uppercase  dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nom complet
                                </th>

                                <th scope="col" class="px-6 py-3">
                                   Email
                                </th>


                                <th scope="col" class="px-6 py-3">
                                    <span class="flex justify-center">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="employe in employes" :key="employe.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ employe.name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-3 font-medium cursor-pointer text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ employe.email }}
                                </th>


                                <td class="">
                                    <div class="flex justify-center items-center gap-10 px-6 py-3 text-right">
                                        <a href="#"
                                            class="cursor-pointer font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Voir</a>

                                        <a @click="affectation(employe.id)"
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
