<script setup lang="ts">
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

let form = useForm({
  email: '',
});

let submit = () => {
  form.post('/generate-token');
};
</script>

<template>
  <Layout :withPadding="true">
    <div class="flex flex-col justify-center items-center px-6 py-7 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h1 class="text-3xl font-bold italic text-gray-900 text-center">
          SkateCraft
        </h1>
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Reset your password</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2">
            </div>
            <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send Reset Token</button>
          </div>
        </form>

        <p class="mt-5 text-center text-sm text-gray-500">
          Remember your password?
          <Link href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign in</Link>
        </p>
      </div>
    </div>
  </Layout>
</template>
