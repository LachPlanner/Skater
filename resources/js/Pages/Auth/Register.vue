<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

let form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

let submit = () => {
    form.post('/register');
}
</script>

<template>
 <Layout :withPadding="false">
    <div class="flex min-h-full flex-col justify-center items-center px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-20 w-auto" src="/public/images/logo.jpg" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create an Account</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <label for="first_name" class="block text-sm font-medium leading-6 text-gray-900">First Name</label>
            <div class="mt-2">
              <input v-model="form.first_name" id="first_name" name="first_name" type="first_name" autocomplete="first_name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2">
              <div v-if="form.errors.first_name" v-text="form.errors.first_name" class="text-red-500 text-xs mt-1"></div>
            </div>
          </div>

          <div>
            <label for="last_name" class="block text-sm font-medium leading-6 text-gray-900">Last Name</label>
            <div class="mt-2">
              <input v-model="form.last_name" id="last_name" name="last_name" type="last_name" autocomplete="last_name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2">
              <div v-if="form.errors.last_name" v-text="form.errors.last_name" class="text-red-500 text-xs mt-1"></div>
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2">
              <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            </div>
            <div class="mt-2">
              <input v-model="form.password" id="password" name="password" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2">
              <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
            </div>
            <div class="mt-2">
              <input v-model="form.password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 pl-2">
              <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
          </div>
        </form>

        <p class="mt-10 mb-10 text-center text-sm text-gray-500">
          Already have an Account?
          <Link href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login</Link>
        </p>
      </div>
    </div>
  </Layout>
</template>