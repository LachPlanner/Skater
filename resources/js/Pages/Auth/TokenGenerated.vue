<script setup lang="ts">
  import { defineProps } from 'vue';
  
  defineProps(['message', 'token', 'email']);
  </script>

<template>
    <Layout :withPadding="true">
      <div class="flex flex-col justify-center items-center px-6 py-7 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <h1 class="text-3xl font-bold italic text-gray-900 text-center">
            SkateCraft
          </h1>
          <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Reset Token Generated</h2>
          <p class="mt-4 text-center text-gray-600">Use this token to reset your password:</p>
          <div class="mt-4 bg-gray-100 p-4 rounded-lg text-left break-words">
            <code class="text-indigo-700 font-semibold text-sm sm:text-base">{{ token }}</code>
          </div>
        </div>
  
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm text-center">
          <Link href="/reset-password" class="mt-5 font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Continue to Reset Password</Link>
        </div>
      </div>
    </Layout>
  </template>

  