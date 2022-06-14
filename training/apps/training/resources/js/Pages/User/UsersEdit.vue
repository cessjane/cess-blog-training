<script>
import Users from "./Users.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
	components: {
		Users,
		Input,
		Label,
		Button,
		ValidationErrors,
		Link
	},
	props: {
		user: Object,
	},
	data() {
		return {
			form: this.$inertia.form({
				id: this.user.id,
				first_name: this.user.first_name,
				last_name: this.user.last_name,
				user_name: this.user.user_name,
				role: this.user.role,
				password: "",
				password_confirmation: "",
			}),

			roles: [
				{ id: 0, title: 'User'},
				{ id: 1, title: 'Admin'},
			],
		};
	},
	methods: {
		submit() {
			this.form.post(route("users.store"), { 
				onFinish: () => this.form.reset("password", "password_confirmation"),
			});
		}
	}
}
</script>

<template>
	<Users>
		<ValidationErrors class="mb-4" />
		<form @submit.prevent="submit">
			<div>
				<Label for="first_name" value="First Name" />
				<Input
					id="first_name"
					type="text"
					class="mt-1 block w-full"
					v-model="form.first_name"
					required
					autofocus
					autocomplete="first_name"
				/>
			</div>

			<div class="mt-4">
				<Label for="last_name" value="Last Name" />
				<Input
					id="last_name"
					type="text"
					class="mt-1 block w-full"
					v-model="form.last_name"
					required
					autocomplete="last_name"
				/>
			</div>

			<div class="mt-4">
				<Label for="user_name" value="User Name" />
				<Input
					id="user_name"
					type="text"
					class="mt-1 block w-full"
					v-model="form.user_name"
					required
					autocomplete="username"
				/>
			</div>

			<div class="mt-4">
				<Label for="role" value="Role" />
				<select 
					v-model="form.role" 
					class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
				>
					<option v-for="role in roles" :value="role.id">{{ role.title }}</option>
				</select>
			</div>

			<div class="mt-4">
				<Label for="password" value="Password" />
				<Input
					id="password"
					type="password"
					class="mt-1 block w-full"
					v-model="form.password"
					required
					autocomplete="new-password"
				/>
			</div>

			<div class="mt-4">
				<Label
					for="password_confirmation"
					value="Confirm Password"
				/>
				<Input
					id="password_confirmation"
					type="password"
					class="mt-1 block w-full"
					v-model="form.password_confirmation"
					required
					autocomplete="new-password"
				/>
			</div>

			<div class="flex items-center justify-end mt-4">
				<Link
					:href="route('users.index')"
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
	</Users>
</template>
