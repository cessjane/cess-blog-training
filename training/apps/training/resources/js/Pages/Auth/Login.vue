<script setup>
import Button from '@/Components/Button.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/Guest.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    // canResetPassword: Boolean,
    canRegister: Boolean,
    status: String,
});

const form = useForm({
    user_name: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <ValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <Label for="user_name" value="User Name" />
                <Input id="user_name" type="text" class="mt-1 block w-full" v-model="form.user_name" required autofocus autocomplete="user_name" />
            </div>

            <div class="mt-4">
                <Label for="password" value="Password" />
                <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </Link> -->

                <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </Button>
            </div>
        </form>

        <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
            Click here to register
        </Link>
    </GuestLayout>
</template>
