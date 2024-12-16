<script lang="ts" setup>
import { computed, ref, watch } from 'vue';
import LinkButton from '../Components/LinkButton.vue';
import Footer from './Footer.vue';
import { router, usePage } from '@inertiajs/vue3';

function handleLogout() {
  router.post('/logout');
}

const page = usePage<{ auth: { isLoggedIn: boolean } }>();
const auth = computed(() => page.props.auth.isLoggedIn);

watch(() => page.props.auth.isLoggedIn, (newValue) => {
  auth.value = newValue;
});

const isMenuOpen = ref(false); // Reaktivt state til dropdown-menu

// Prop for at kontrollere padding på main
defineProps({
  withPadding: {
    type: Boolean,
    default: true,
  },
});
</script>

<template>
  <div class="flex flex-col min-h-screen bg-white">
    <!-- Navigation -->
    <nav class="flex justify-between items-center bg-black text-white py-6 border-b border-white/20">
      <div class="px-5">
        <Link href="/" class="font-bold italic">SkateCraft</Link>
      </div>

      <!-- Hamburger-menu til små skærme -->
      <div class="md:hidden px-5">
        <button @click="isMenuOpen = !isMenuOpen" class="focus:outline-none">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M4 6h16M4 12h16m-7 6h7"
            />
          </svg>
        </button>
      </div>

      <!-- Menuen til store skærme -->
      <div class="hidden md:flex px-5 space-x-5 font-bold">
        <LinkButton href="/shop">Shop</LinkButton>
        <LinkButton href="/board">Board</LinkButton>
        <LinkButton href="/trucks">Trucks</LinkButton>
        <LinkButton href="/wheels">Wheels</LinkButton>
        <LinkButton href="/build">Build your own board</LinkButton>
      </div>

      <!-- Brugermenu -->
      <div v-if="!auth" class="hidden md:flex px-5">
        <LinkButton href="/register">Register</LinkButton>
        <LinkButton class="ml-5" href="/login">Login</LinkButton>
      </div>

      <div v-if="auth" class="hidden md:flex px-5">
        <LinkButton :href="'/cart'">Cart</LinkButton>
        <LinkButton href="#">Profile</LinkButton>
        <button 
          class="inline-flex items-center px-2 py-2 bg-black border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-white hover:text-black active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
          @click="handleLogout"
        >Logout</button>
      </div>
    </nav>

    <!-- Dropdown-menu til små skærme -->
    <div v-if="isMenuOpen" class="md:hidden bg-black text-white px-5 py-4 flex flex-col space-y-4">
      <LinkButton href="/shop">Shop</LinkButton>
      <LinkButton href="/board">Board</LinkButton>
      <LinkButton href="/trucks">Trunks</LinkButton>
      <LinkButton href="/wheels">Wheels</LinkButton>
      <LinkButton href="/build">Build your own board</LinkButton>
      <LinkButton v-if="!auth" href="/register">Register</LinkButton>
      <LinkButton v-if="!auth" href="/login">Login</LinkButton>
      <LinkButton v-if="auth" href="/cart">Cart</LinkButton>
      <LinkButton v-if="auth" href="#">Profile</LinkButton>
      <button 
        v-if="auth"
        class="inline-flex items-center px-2 py-2 bg-black border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-white hover:text-black active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
        @click="handleLogout"
      >Logout</button>
    </div>

    <!-- Main Content -->
    <main :class="withPadding ? 'flex-1 p-6 flex items-center justify-center' : 'flex-1'">
      <slot />
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>

