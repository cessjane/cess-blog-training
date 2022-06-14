<script>
import Categories from "./Categories.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
	components: {
		Categories,
		Input,
		Label,
		Button,
		ValidationErrors,
		Link
	},
	props: {
		auth_user: Object,	
	},
	data() {
		return {
			form: this.$inertia.form({
				name: "",
				updated_user_id: this.auth_user.id,
				created_at: "",
				updated_at: "",
			}),
		}
	},
	methods: {
		submit() {
			this.form.post(route("categories.store"));
		}
	}
}
</script>

<template>
	<Categories>
		<ValidationErrors class="mb-4" />

		<form @submit.prevent="submit">
			<div>
				<Label for="name" value="Category Name" />
				<Input
					id="name"
					type="text"
					class="mt-1 block w-full"
					v-model="form.name"
					required
					autofocus
					autocomplete="name"
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
					:href="route('categories.index')"
					class="rounded-md bg-gray-800 hover:bg-gray-700 px-4 py-2 text-white text-xs uppercase"
				>
					Back
				</Link>

				<Button
					class="ml-4 bg-green-500 hover:bg-green-700"
					:class="{ 'opacity-25': form.processing }"
					:disabled="form.processing"
				>
					Create
				</Button>
			</div>
		</form>
	</Categories>
</template>
