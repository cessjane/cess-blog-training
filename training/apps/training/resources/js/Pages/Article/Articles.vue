<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
  <Head title="Articles" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Articles
      </h2>
    </template>

    <div class="md:flex min-h-screen h-full">
			<div class="mx-auto sm:px-6 lg:px-8 w-full py-8">
				<div
					class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
				>
					<div class="p-8 bg-white border-b border-gray-200">
						<slot />
					</div>
				</div>
			</div>
    </div>
  </AuthenticatedLayout>
</template>
