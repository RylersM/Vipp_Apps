<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import Icon from '@/Components/Icons/Icon.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="absolute top-0 bottom-0 left-0 right-0 z-50">
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100  fixed top-0 left-0 right-0  ">
                <!-- Primary Navigation Menu -->
                <div class=" mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 ">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('admindashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>


                        </div>

                        <div class="flex items-center">
                            <!-- Settings Dropdown -->
                            <div class=" z-50 relative ">
                                <Dropdown align="right">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 ">

                                                <Icon name="plus" />
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('application.create')"> Ajouter une application
                                        </DropdownLink>
                                        <DropdownLink :href="route('entreprise.inscription')"> Ajouter une entreprise
                                        </DropdownLink>
                                        <DropdownLink :href="route('utilisateurs.create')">
                                            Ajouter un utilisateur
                                        </DropdownLink>

                                        <!-- Settings Dropdown -->
                                        <div class=" z-50 relative ">
                                            <Dropdown align="right" width="" class="z-50">
                                                <template #trigger>
                                                    <span class="inline-flex rounded-md">
                                                        <button type="button"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 ">


                                                        </button>
                                                    </span>
                                                </template>

                                                <template #content>
                                                    <DropdownLink :href="route('application.create')"> Ajouter une
                                                        application
                                                    </DropdownLink>
                                                    <DropdownLink :href="route('entreprise.inscription')">
                                                        Ajouter une entreprise
                                                    </DropdownLink>
                                                    <DropdownLink :href="route('utilisateurs.create')">
                                                        Ajouter un utilisateur
                                                    </DropdownLink>
                                                </template>
                                            </Dropdown>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>
                            <div class="hidden sm:flex sm:items-center  ">
                                <!-- Settings Dropdown -->
                                <div class=" relative z-50">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name }}

                                                    <Icon name="dropdown" />
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Deconnexion
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('admindashboard')"
                            :active="route().current('admindashboard')">
                            <Icon name="dashbord" />
                            Tableau de bord
                        </ResponsiveNavLink>
                        <ResponsiveNavLink class="flex gap-2 items-center" :href="route('application.index')"
                            :active="route().current('application.index')">
                            <Icon name="apps" />
                            Applications
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Déconnexion
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
                aria-controls="sidebar-multi-level-sidebar" type="button"
                class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>

            <aside id="sidebar-multi-level-sidebar"
                class="fixed top-16 left-0 z-50  h-screen transition-transform -translate-x-full sm:translate-x-0"
                aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-white ">
                    <ul class=" font-medium">
                        <li>
                            <ResponsiveNavLink class="flex gap-2 items-center" :href="route('admindashboard')"
                                :active="route().current('admindashboard')">
                                <Icon name="dashbord" />
                                Tableau de bord
                            </ResponsiveNavLink>

                        </li>
                        <li>
                            <ResponsiveNavLink class="flex gap-2 items-center" :href="route('application.index')"
                                :active="route().current('application.index')">
                                <Icon name="apps" />
                                Applications
                            </ResponsiveNavLink>

                        </li>
                        <li>
                            <ResponsiveNavLink class="flex gap-2 items-center" :href="route('entreprise.index')"
                                :active="route().current('entreprise.index') || route().current('entreprise.affectation')">
                                <Icon name="building" />
                                Entreprises
                            </ResponsiveNavLink>

                        </li>
                        <li>
                            <ResponsiveNavLink class="flex gap-2 items-center" :href="route('utilisateurs.index')"
                                :active="route().current('utilisateurs.index') || route().current('employe.affectation')">
                                <Icon name="user" />
                                Utilisateurs
                            </ResponsiveNavLink>

                        </li>

                    </ul>
                </div>
            </aside>




            <!-- Page Heading -->
            <header class="bg-white shadow sticky top-16" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8  mt-16 ">

                    <slot name="header" />

                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="sm:pl-[16rem]  sm:pr-[2.5rem] pt-16 z-50">
                    <slot />

                </div>
            </main>
        </div>
    </div>
</template>
<!--    -->
