<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Alert from '@/Components/Alert.vue';
import { Link } from '@inertiajs/inertia-vue3';
import VueCal from 'vue-cal';
import 'vue-cal/dist/vuecal.css';

const showingNavigationDropdown = ref(false);
</script>
<template>
  <div class="min-h-screen min-w-fit bg-gray-100">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-100">
      <!-- Primary Navigation Menu -->
      <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
              <Link :href="route('dashboard')">
                <ApplicationLogo class="block h-9 w-auto" />
              </Link>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Dashboard
              </NavLink>

              <NavLink :href="route('users.index')" :active="route().current('users.index')">
                Users
              </NavLink>

              <NavLink :href="route('articles.index')" :active="route().current('articles.index')">
                Articles
              </NavLink>

              <NavLink :href="route('categories.index')" :active="route().current('categories.index')">
                Categories
              </NavLink>
            </div>
          </div>

          <!-- Hamburger -->
          <div class="-mr-2 flex items-center sm:hidden">
            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
          <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
          </ResponsiveNavLink>

          <ResponsiveNavLink :href="route('users.index')" :active="route().current('users.index')">
            Users
          </ResponsiveNavLink>

          <ResponsiveNavLink :href="route('articles.index')" :active="route().current('articles.index')">
            Articles
          </ResponsiveNavLink>

          <ResponsiveNavLink :href="route('categories.index')" :active="route().current('categories.index')">
            Categories
          </ResponsiveNavLink>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="px-4">
            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.user_name }}</div>
          </div>

          <div class="mt-3 space-y-1">
            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
              Log Out
            </ResponsiveNavLink>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Heading -->
    <header class="bg-white shadow" v-if="$slots.header">
      <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="header" />
      </div>
    </header>

    <!-- Page Content -->
    <main>
      <div class="md:flex h-full">
        <div class="md:flex-1">
          <slot />
        </div>
        <div class="md:flex md:flex-col items-center bg-gray-200 md:w-96 p-2 hidden min-h-screen md:space-y-8">
          <div class="pt-8">
            <p>
              Hello 
              <strong class="uppercase">
                {{ $page.props.auth.user.first_name }}
                {{ $page.props.auth.user.last_name }}
              </strong>!
            </p>
          </div>
          <div>
            <Link :href="route('logout')" method="post" as="button" class="rounded bg-red-500 hover:bg-red-700 w-full px-4 py-2 text-white text-xs uppercase">
              Logout
            </Link>
          </div>
          <div class="px-4">
            <VueCal
              class="vuecal--date-picker vuecal--green-theme"
              xsmall
              hide-view-selector
              :time="false"
              :transitions="false"
              active-view="month"
              :disable-views="['week']"
              style="width: 210px;height: 230px; background-color: white;">
            </VueCal>
          </div>
        </div>
      </div>  
    </main>
  </div>
</template>
