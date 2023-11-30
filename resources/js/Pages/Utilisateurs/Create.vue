<script setup>
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});


// Fonction permettant d'ajouter une nouvelle entreprise.
let successMessage = ref("");
let errorMessage = ref("");
const submit = () => {
    axios.post(route('utilisateurs.store', form))
        .then(response => {
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

            // Réinitialisation du formulaire
            form.name = '';
            form.email = '';
            form.password = '';
            form.password_confirmation = '';
            form.terms = false;
        })
        .catch(error => {
            // Gestion des erreurs ici
            console.error(error);
        });
};

</script>

<template>
    <AuthenticatedLayoutAdmin>

        <Head title="Création d'utilisateur" />
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

        <div class="flex justify-center items-center  " style="height: calc(100vh - 60px);">
            <div class="w-full shadow-md max-w-md p-5 z-50 rounded-lg form">

                <div>
                    <InputLabel for="name" value="Nom & prénoms" />

                    <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                        autocomplete="name" />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Mot de passe" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirmer mot de passe" />

                    <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                        v-model="form.password_confirmation" required autocomplete="new-password" />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Déja inscrit?
                    </Link>

                    <div class=" cursor-pointer ml-4 inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-600 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-teal-800 focus:ring-offset-1 transition ease-in-out duration-150"
                        @click="submit">
                        Inscription
                    </div>
                </div>
            </div>

        </div>
        <div class="circle"></div>
        <div class="circle-1"></div>
        <div class="circle-2"></div>
    </AuthenticatedLayoutAdmin>
</template>
<style scope>
:root {
    --accent: #FFA500;
    --color1: linear-gradient(to bottom right, #0A2E5A, #0059c5);
    --transparent: rgb(255, 255, 255, 0.3);
}

/* body {
  font-family: 'Source Sans Pro', sans-serif;
  background-color: #EEEEEE;
  display: flex;
  justify-content: center;
} */

.form {
    display: flex;
    flex-direction: column;
    background-color: var(--transparent);
    color: var(--accent);
    position: absolute;
    padding: 10px 30px;
    margin-top: 50px;
    backdrop-filter: blur(10px);
    border: 2px solid var(--transparent);
    border-radius: 16px;

}

.circle {
    position: absolute;
    top: 55%;
    left: 50%;
    background: var(--color1);
    border-radius: 50%;
    z-index: 1;
    width: 100px;
    height: 100px;
    transform: translate(-150px, -220px);
}

.circle-1 {
    position: absolute;
    top: 50%;
    left: 50%;
    background: var(--color1);
    width: 250px;
    height: 250px;
    border-radius: 50%;
    transform: translate(200px, 100px);
    z-index: 1;
}

.circle-2 {
    position: absolute;
    top: 50%;
    left: 50%;
    background: var(--color1);
    width: 150px;
    height: 150px;
    border-radius: 50%;
    transform: translate(-200px, 150px);
    z-index: 1;
}
</style>

