<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Icon from '@/Components/Icons/Icon.vue';
import NavLink from '@/Components/NavLink.vue';
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
                class=" left-0  w-64 bg-white shadow-2xl rounded-xl text-[#03224c] flex flex-col justify-between  m-3 p-4">
                <div>
                    <ApplicationLogo />
                    <div class="mt-8">
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('employedashboard')"
                            :active="route().current('entreprisedashboard')">
                            <Icon name="dashbord" />
                            Tableau de bord
                        </ResponsiveNavLink>
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('employe.pageformation')"
                            :active="route().current('employe.pageformation') || route().current('employe.showformation')">
                            <Icon name="apps" />
                          Applications
                        </ResponsiveNavLink>
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('employe.pageformation')"
                            :active="route().current('employe.pageformation') || route().current('employe.showformation')">
                            <Icon name="learning" />
                            Mes formations
                        </ResponsiveNavLink>
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('employe.pageformation')"
                            :active="route().current('employe.pageformation') || route().current('employe.showformation')">
                            <Icon name="user" />
                            Utilisateurs
                        </ResponsiveNavLink>


                    </div>
                </div>

                <div class="mb-4">
                    <a :href="route('profile.edit')"
                        class="flex flex-col px-2 py-3 mb-2 border shadow-md cursor-pointer rounded-xl">
                        <span>{{ $page.props.auth.user.enseigne
                        }}</span>
                        <!-- <span class="text-[#39d2c0] ">{{ $page.props.auth.user.email
                        }}</span> -->
                    </a>
                    <div class="flex justify-between">

                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="flex justify-between ">
                            <span class="text-[#F00020]">Déconnexion </span>
                            <Icon name="logout" />
                        </ResponsiveNavLink>
                    </div>

                </div>
            </aside>


            <div class="w-full ">

                <slot />
            </div>


        </div>

    </body>
</template>
