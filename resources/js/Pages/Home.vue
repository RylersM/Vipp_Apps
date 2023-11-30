<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Hero from '@/Components/Home/Hero.vue';
import Tuto from '@/Components/Home/Tuto.vue';
import About from '@/Components/Home/About.vue';
import Footer from '@/Components/Home/Footer.vue';
import Solution from '@/Components/Home/Solution.vue';
import Teams from '@/Components/Home/Teams.vue';
import Contact from '@/Components/Home/Contact.vue';
import { onMounted, ref } from 'vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});


const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('absent');
        } else {
            entry.target.classList.remove('absent');
        }
    });
});

const hiddenElements = ref([]);

onMounted(() => {
    hiddenElements.value.forEach((el) => observer.observe(el));
});
</script>

<template>
    <Head title="Home" />

    <GuestLayout>

        <body class="nunito">

            <Hero></Hero>
            <About></About>
            <Tuto class="show" ref="hiddenElements"></Tuto>
            <!-- <Solution class="show" ref="hiddenElements"></Solution> -->
            <Teams class="show" ref="hiddenElements"></Teams>
            <Contact class="show" ref="hiddenElements"></Contact>
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
