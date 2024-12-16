<script setup lang="ts">
import LinkButton from '@/Components/LinkButton.vue';
import { User } from '@/System/Entities';

// Hent brugerens data fra props
defineProps<{user: User}>()
</script>

<template>
  <Layout>
    <div class="container mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-6 text-center">Your Profile</h1>

      <!-- Brugerinformation -->
      <div class="bg-white p-6 shadow-md rounded-md max-w-lg mx-auto">
        <div class="mb-4">
          <p class="text-gray-600">First Name</p>
          <h2 class="text-xl font-semibold">{{ user.first_name }}</h2>
        </div>
        <div class="mb-4">
          <p class="text-gray-600">Last Name</p>
          <h2 class="text-xl font-semibold">{{ user.last_name }}</h2>
        </div>
        <div class="mb-4">
          <p class="text-gray-600">Email</p>
          <h2 class="text-xl font-semibold">{{ user.email }}</h2>
        </div>

        <!-- Knap til Order History -->
        <div class="text-center mt-6">
          <LinkButton href="/orders" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
            View Order History
          </LinkButton>
        </div>
      </div>
    </div>
  </Layout>
</template>
