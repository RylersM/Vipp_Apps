<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import About from '@/Components/Home/About.vue'
import Footer from '@/Components/Home/Footer.vue'


</script>

<template>
    <Head title="A propos" />

    <GuestLayout>

        <body class="nunito">


            <About></About>

            <div class="container mx-auto px-4 py-8 grid grid-cols-2 gap-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold">Formation personnalisée pour les employés.</h1>
        <p class="mt-4">Notre plateforme de e-learning offre la possibilité aux entreprises de former leurs employés de manière personnalisée sur nos applications. Cela permet de maximiser l'utilisation des outils et d'accroître l'efficacité au sein de l'organisation.</p>
    </div>

    <div class="mb-8">
        <h1 class="text-4xl font-bold">Amélioration de la productivité.</h1>
        <p class="mt-4">Grâce à une formation approfondie et adaptée aux besoins spécifiques de l'entreprise, les employés gagneront en compétences et en confiance dans l'utilisation des applications. Cela se traduit par une augmentation significative de la productivité globale de l'entreprise.</p>
    </div>

    <div class="mb-8">
        <h1 class="text-4xl font-bold">Gestion simplifiée des licences.</h1>
        <p class="mt-4">Notre système de gestion des licences permet aux entreprises d'acheter facilement des licences pour les applications pertinentes et de les attribuer aux employés concernés. Cela facilite la gestion de l'accès et garantit que seuls les utilisateurs autorisés ont accès aux formations.</p>
    </div>

    <div class="mb-8">
        <h1 class="text-4xl font-bold">Suivi des progrès des employés.</h1>
        <p class="mt-4">Les tableaux de bord d'analyse offrent aux responsables une visibilité sur les progrès de leurs employés dans les formations. Cela permet de surveiller les performances individuelles et d'identifier les besoins supplémentaires en formation.</p>
    </div>
</div>


            <Footer></Footer>
        </body>

    </GuestLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.nunito {
    font-family: Nunito;
}

@font-face {
    font-family: Nunito;
    src: url(../../fonts/nunito/static/Nunito-Regular.ttf);
}

.absent {
    opacity: 0;
    transition: all 1s;
    filter: blur(1px);
    transform: translateY(20%);
}

.show {
    opacity: 1;
    filter: blur(0);
    transform: translateY(0);
}
</style>
