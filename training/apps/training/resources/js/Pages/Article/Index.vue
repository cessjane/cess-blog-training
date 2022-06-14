<script setup>
import Articles from './Articles.vue';
import SearchBox from "@/Components/Searchbox.vue";
import Alert from "@/Components/Alert.vue";
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
  articles: Object,
});

const destroy = (id) => {
  if (confirm('Are you sure you want to delete this article?')) {
    Inertia.delete(`/articles/${id}`)
  }
};
</script>

<template>
  <Alert v-if="$page.props.flash.message" :color="$page.props.flash.color" :message="$page.props.flash.message" />
  <Articles>
    <div class="md:flex pb-3 justify-end">
      <div class="md:flex-1 md:grow mr-4 hidden">
        <SearchBox></SearchBox>
      </div>
      <div class="md:flex items-center">
        <Link :href="$page.props.create_url" class="rounded bg-green-500 hover:bg-green-700 w-full px-4 py-2 text-white text-xs uppercase">
          Add New
        </Link>
      </div>
    </div>

    <div class="md:flex overflow-x-auto shadow-md sm:rounded-lg">
      <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              Category
            </th>
            <th scope="col" class="px-6 py-3">
              Title
            </th>
            <th scope="col" class="px-6 py-3">
              Slug
            </th>
            <th scope="col" class="px-6 py-3">
              Image
            </th>
            <th scope="col" class="px-6 py-3">
              Updated By
            </th>
            <th scope="col" class="px-6 py-3">
              Created At
            </th>
            <th scope="col" class="px-6 py-3">
              Updated At
            </th>
            <th scope="col" class="px-6 py-3">
              <span class="sr-only">Edit</span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="article in articles.data"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
              {{ article.article_category_id }}
            </td>
            <td class="px-6 py-4">
              {{ article.title }}
            </td>
            <td class="px-6 py-4">
              {{ article.slug }}
            </td>
            <td class="px-6 py-4">
              <img :src="article.image_path" alt="" width="100" height="100">
            </td>
            <td class="px-6 py-4">
              {{ article.updated_user_id }}
            </td>
            <td class="px-6 py-4">
              {{ article.created_at }}
            </td>
            <td class="px-6 py-4">
              {{ article.updated_at }}
            </td>
            <td class="px-6 py-4 text-right">
              <a :href="article.edit_url" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
              <a @click="destroy(article.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline ml-4 hover:cursor-pointer">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <Pagination class="mt-6" :links="articles.meta.links" />
  </Articles>
</template>