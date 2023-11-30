<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3'


</script>
<template>
    <div class="sticky top-0 w-full bg-white shadow-lg z-50" >
        <nav class="container  mx-auto px-5 md:px-0 py-2 flex justify-between items-center z-50 bg-white">
        <Link href="/">
            <ApplicationLogo />
        </Link>

        <ul class="flex gap-10">
            <li>
                <a href="/" class="text-[#0A2E5A] hover:text-[#0054bb]">
                    Acceuil
                </a>
            </li>
            <li>
                <a href="about" class="text-[#0A2E5A] hover:text-[#0054bb]">
                    A propos
                </a>
            </li>
            <li>
                <a href="catalogue" class="text-[#0A2E5A] hover:text-[#0054bb]">
                    Catalogues
                </a>
            </li>
            <li>
                <a class="text-[#0A2E5A] hover:text-[#0054bb]">
                    Pourquoi nous
                </a>
            </li>
        </ul>

        <div>
            <ul class="">
                <li><a href="login" class="text-[#0A2E5A] hover:text-[#0054bb]">
                    Connexion
                </a></li>

            </ul>
        </div>



    </nav>
    </div>
</template>


<style></style>
