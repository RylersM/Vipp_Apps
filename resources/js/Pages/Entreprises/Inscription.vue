<script setup>
import { Head } from '@inertiajs/vue3';
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';

const form = reactive({
    email: null,
    nom: null,
    prenom: null,
    enseigne: null,
    username: null,
    pays: null,
    prefixe: null,
    telephone: null,
    nombre_utilisateurs_requis: null,
})

// Fonction permettant d'ajouter une nouvelle entreprise.
let successMessage = ref("");
let errorMessage = ref("");
function submit() {
    axios.post('/entreprise/store', form)
        .then((response) => {

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


            form.email = null;
            form.username = null;
        })

}


</script>
<template>
    <Head title="Incription" />

    <AuthenticatedLayoutAdmin>

        <body class="bg-gray-100">
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



            <div class="flex items-center justify-center  mx-auto" style="height: calc(100vh - 60px);">
                <div class="w-1/3 flex justify-center">
                    <div class="">
                        <img :src="'/images/lala.png'" alt="image" class="w-full" />
                    </div>
                </div>


                <div class=" w-1/ ">
                    <h1 class="text-2xl font-semibold mb-4">Création d'une entreprise</h1>
                    <form class="space-y-4 w-full">
                        <div class="flex gap-5  w-full">

                            <div class=" w-2/4">
                                <label for="nom" class="block text-gray-700">Nom du gérant <span
                                        class="text-red-700">*</span> :</label>
                                <input type="text" id="nom" name="nom" required v-model="form.nom"
                                    class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                            </div>

                            <div class=" w-2/4">
                                <label for="prenom" class="block text-gray-700">Prénom du gérant<span
                                        class="text-red-700">*</span> :</label>
                                <input type="text" id="prenom" name="prenom" required v-model="form.prenom"
                                    class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                            </div>
                        </div>

                        <div class="flex gap-5  w-full">
                            <div class=" w-2/4">
                                <label for="enseigne" class="block text-gray-700">Nom de l'entreprise <span
                                        class="text-red-700">*</span> :</label>
                                <input type="text" id="enseigne" name="enseigne" required v-model="form.enseigne"
                                    class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                            </div>

                            <div class=" w-2/4">
                                <label for="email" class="block text-gray-700">Email <span class="text-red-700">*</span>
                                    :</label>
                                <input type="email" id="email" name="email" required v-model="form.email"
                                    class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                            </div>
                        </div>

                        <div class="flex gap-5  ">
                            <div class=" w-2/4">
                                <label for="username" class="block text-gray-700">Nom d'utilisateur <span
                                        class="text-red-700">*</span> :</label>
                                <input type="username" id="username" name="username" required v-model="form.username"
                                    class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                            </div>
                            <div class="w-2/4">
                                <label for="pays" class="block text-gray-700">Pays de l'entreprise <span
                                        class="text-red-700">*</span> :</label>
                                <input list="paysList" type="text" id="pays" name="pays" required v-model="form.pays"
                                    class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                            </div>

                            <datalist id="paysList">
                                <option value="Algérie"></option>
                                <option value="Angola"></option>
                                <option value="Bénin"></option>
                                <option value="Botswana"></option>
                                <option value="Burkina Faso"></option>
                                <option value="Burundi"></option>
                                <!-- Ajoutez d'autres options pour d'autres pays africains -->
                            </datalist>
                        </div>

                        <div class="flex gap-5  w-full">
                            <div class="w-2/4">
                                <div class="flex">
                                    <div class="w-1/4">
                                        <label for="telephone" class="block text-gray-700">Préfixe<span
                                                class="text-red-700">*</span> :</label>
                                        <input list="prefixeList" id="prefixe" name="prefixe" required
                                            v-model="form.prefixe"
                                            class="rounded-l border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                                        <datalist id="prefixeList">
                                            <!-- Options pour les préfixes de numéro de téléphone -->
                                            <option value="+1"></option>
                                            <option value="+33"></option>
                                            <option value="+44"></option>
                                            <!-- Ajoutez d'autres options au besoin -->
                                        </datalist>
                                    </div>
                                    <div class="w-full">
                                        <label for="telephone" class="block text-gray-700">Téléphone<span
                                                class="text-red-700">*</span> :</label>
                                        <input type="tel" id="numero" name="numero" required v-model="form.telephone"
                                            class="w-full rounded-r border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 ">
                                    </div>
                                </div>
                            </div>


                            <div class=" w-2/4">
                                <label for="nombre_utilisateurs_requis" class="block text-gray-700">Nombre
                                    d'utilisateurs<span class="text-red-700">*</span>
                                    requis
                                    :</label>

                                <select id="nombre_utilisateurs_requis" name="nombre_utilisateurs_requis"
                                    class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500 "
                                    required v-model="form.nombre_utilisateurs_requis">
                                    <option value="1-5">1-5</option>
                                    <option value="6-15">6-15</option>
                                    <option value="16-50">16-50</option>
                                    <option value="50-100">50-100</option>
                                </select>

                            </div>
                        </div>

                        <div class="flex justify-center ">
                            <span type="submit" @click="submit"
                                class="w-full text-center cursor-pointer hover:bg-blue-500 bg-blue-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-700">
                                Inscription
                            </span>

                        </div>
                    </form>
                </div>
            </div>


        </body>
    </AuthenticatedLayoutAdmin>
</template>


<style></style>
