<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import Icon from '@/Components/Icons/Icon.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { router } from '@inertiajs/vue3'

import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';


const searchInput = ref('');

// Gérer les événements de recherche
function handleSearch() {
    console.log('Recherche effectuée :', searchInput.value);
}

const showingNavigationDropdown = ref(false);
</script>

<template>
    <body class=" bg-gray-100 h-screen">
        <div class="flex h-screen overflow-scroll gap-5">
            <aside
                class=" fixed left-0 h-[97%] w-64 bg-white shadow-2xl rounded-xl text-[#03224c] flex flex-col justify-between m-3 p-4">
                <div>
                    <ApplicationLogo />
                    <div class="mt-8">
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('employedashboard')"
                        :active="route().current('employedashboard')" >
                        <Icon name="dashbord" />
                                Tableau de bord
                            </ResponsiveNavLink>
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('employe.pageformation')"
                        :active="route().current('employe.pageformation') || route().current('employe.showformation')" >
                        <Icon name="learning" />
                                Mes formations
                            </ResponsiveNavLink>


                    </div>
                </div>

                <div class="mb-4">
                    <a :href="route('profile.edit')"
                        class="flex flex-col px-2 py-3 mb-2 border shadow-md cursor-pointer rounded-xl">
                        <span>{{ $page.props.auth.user.name
                        }}</span>
                        <!-- <span class="text-[#39d2c0] ">{{ $page.props.auth.user.email
                        }}</span> -->
                    </a>
                    <div class="flex justify-between">


                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="flex justify-between ">
                                <span class="text-[#F00020]">Déconnexion </span>
                                <Icon  name="logout"/>
                            </ResponsiveNavLink>
                    </div>

                </div>
            </aside>


            <div class="w-full ml-64">

                <slot />
            </div>


        </div>

    </body></template>
