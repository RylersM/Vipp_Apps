<script setup>
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const loginForm = reactive({
    email: null,
    mot_de_passe: null,
})

function submitLogin() {
    router.post('/entreprise/login', loginForm)
}
</script>

<template>
    <Head title="Connexion" />

    <GuestLayout>

        <body class="bg-gray-100">

            <div class="flex items-center justify-center  mx-auto" style="height: calc(100vh - 60px);">
                <div class="w-1/3 flex justify-center">
                    <div class="">
                        <img :src="'/images/lala.png'" alt="image" class="w-full" />
                    </div>
                </div>

                <div class="w-1/3">
                    <h1 class="text-2xl font-semibold mb-4">Connexion</h1>
                    <form @submit.prevent="submitLogin" class="space-y-4 w-full">
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email :</label>
                            <input type="email" id="email" name="email" required v-model="loginForm.email"
                                class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="mot_de_passe" class="block text-gray-700">Mot de passe :</label>
                            <input type="password" id="mot_de_passe" name="mot_de_passe" required
                                v-model="loginForm.mot_de_passe"
                                class="w-full rounded border border-gray-300 py-2 px-3 focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-700">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    </GuestLayout>
</template>
