<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="flex justify-center items-center  " style="height: calc(100vh - 60px);">
            <form @submit.prevent="submit" class="w-full shadow-md max-w-md p-5 rounded-lg form">
                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Mot de passe" />

                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="current-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-slate-900">Se souvenir</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Mot de passe oublier?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Connexion
                    </PrimaryButton>
                </div>
            </form>
        </div>
        <div class="circle"></div>
        <div class="circle-1"></div>
        <div class="circle-2"></div>
    </GuestLayout>
</template>
<style scope>
:root {--accent: #FFA500;
--color1: linear-gradient(to bottom right, #0A2E5A, #0059c5);
--transparent: rgb(255, 255, 255, 0.3);}

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
  z-index: -1;
  width: 100px;
  height: 100px;
  transform: translate(-250px, -200px);
}

.circle-1 {
  position: absolute;
  top: 50%;
  left: 50%;
  background: var(--color1);
  width: 250px;
  height: 250px;
  border-radius: 50%;
  transform: translate(100px, 50px);
  z-index: -1;
}

.circle-2 {
  position: absolute;
  top: 50%;
  left: 50%;
  background: var(--color1);
  width: 150px;
  height: 150px;
  border-radius: 50%;
  transform: translate(-250px, 50px);
  z-index: -1;
}
</style>
