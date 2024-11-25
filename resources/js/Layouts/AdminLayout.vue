<script setup>
import { router } from '@inertiajs/vue3';
import LinkButton from '../Components/LinkButton.vue';

// Menu Items
const menuItems = [
  { name: 'Dashboard', link: '/admin/models' },
  { name: 'Orders', link: '/admin/orders' },
];

// Handle Logout
function handleLogout() {
  router.post('/admin/logout');
}
</script>

<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Side Menu -->
    <aside class="w-64 bg-black text-white flex flex-col justify-between">
      <div>
        <!-- Menu Header -->
        <div class="p-6">
          <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
        </div>

        <!-- Menu Items -->
        <nav class="space-y-4 px-6 flex flex-col">
          <LinkButton
            v-for="item in menuItems"
            :key="item.name"
            :href="item.link"
            class="flex items-center py-2 px-4 rounded-md hover:bg-white hover:text-black transition duration-150"
          >
            <!-- Dot -->
            <span class="w-2 h-2 bg-gray-400 rounded-full mr-4"></span>
            <!-- Menu Text -->
            {{ item.name }}
          </LinkButton>
        </nav>
      </div>

      <!-- Logout Button -->
      <div class="p-6">
        <button
          @click="handleLogout"
          class="w-full py-2 px-4 bg-black text-white font-semibold rounded-md hover:bg-white hover:text-black transition duration-150"
        >
          Logout
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
      <slot />
    </main>
  </div>
</template>
