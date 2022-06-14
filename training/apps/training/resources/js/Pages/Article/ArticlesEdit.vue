<script>
import Articles from "./Articles.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
	components: {
		Articles,
		Input,
		Label,
		Button,
		ValidationErrors,
		Link,
	},
	props: {
		article: Object,
		categories: Object,
	},
	data() {
		return {
			form: this.$inertia.form({
				id: this.article.id,
				article_category_id: this.article.article_category_id,
				title: this.article.title,
				slug: this.article.slug,
				contents: this.article.contents,
				image_path: this.article.image_path,
				updated_user_id: this.article.updated_user_id,
			}),

			editor: ClassicEditor,
			editorConfig: {
				// ckeditor config
			},

			tempImage: '/' + this.article.image_path,
		};
	},
	methods: {
		changeImage() {
			this.tempImage = URL.createObjectURL(this.form.image_path);
		},
		submit() {
			this.form.post(route("articles.store"));
		}
	}
}
</script>

<template>
	<Articles>
		<ValidationErrors class="mb-4" />
		<form @submit.prevent="submit">
			<div>
				<Label for="title" value="Title" />
				<Input
					id="title"
					type="text"
					class="mt-1 block w-full"
					v-model="form.title"
					required
					autofocus
					autocomplete="title"
				/>
			</div>

			<div class="mt-4">
				<Label for="article_category_id" value="Category" class="form-label inline-block mb-2 text-gray-700" />
				<select 
					v-model="form.article_category_id" 
					class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
				>
					<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
				</select>
			</div>

			<div class="mt-4">
				<Label for="slug" value="Slug" />
				<Input
					id="slug"
					type="text"
					class="mt-1 block w-full"
					v-model="form.slug"
					required
					autocomplete="slug"
				/>
			</div>

			<div class="mt-4">
				<Label for="contents" value="Contents" />
				<ckeditor :editor="editor" v-model="form.contents" :config="editorConfig" class="overflow-auto max-h-40"></ckeditor>
			</div>

			<div class="mt-4">
				<Label for="image_path" value="Image" />
				<Input
					id="image_path"
					@input="form.image_path = $event.target.files[0]"
					@change="changeImage()"
					type="file"
					class="
						mt-1 
						block 
						w-full
						px-3
						py-1.5
						text-base
						font-normal
						text-gray-700
						bg-white 
						bg-clip-padding
						border border-solid 
						border-gray-300
						rounded
						transition
						ease-in-out
						m-0
    			focus:text-gray-700 
					focus:bg-white 
					focus:border-blue-600 
						focus:outline-none"
					autocomplete="image_path"
				/>
				<img
					:src="tempImage ?? `/images/preview.png`"
					class="p-1 max-w-sm mt-4"
					alt=""
				/>
			</div>

			<div class="mt-4">
				<Label for="updated_user_id" value="Updated By" />
				<Input
					id="updated_user_id"
					type="text"
					class="mt-1 block w-full bg-gray-200"
					v-model="form.updated_user_id"
					required
					disabled
					autocomplete="updated_user_id"
					:value="$page.props.auth.user.first_name + ' ' + $page.props.auth.user.last_name"
				/>
			</div>

			<div class="flex items-center justify-end mt-4">
				<Link
					:href="route('articles.index')"
					class="rounded-md bg-gray-800 hover:bg-gray-700 px-4 py-2 text-white text-xs uppercase"
				>
					Back
				</Link>

				<Button
					class="ml-4 bg-green-500 hover:bg-green-700"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					Save
				</Button>
			</div>
		</form>
	</Articles>
</template>
