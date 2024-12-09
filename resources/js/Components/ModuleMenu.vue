<script lang="ts" setup>
import { usePage } from '@inertiajs/vue3';
import { computed, watch } from 'vue';
// Definér typen for et modul
interface Module {
  name: string;
  image: string;
}

// Definér props med TypeScript
defineProps<{
  modules: Module[]; // Liste af moduler
}>();

const page = usePage();
const auth = computed(() => page.props.auth.isLoggedIn);

watch(() => page.props.auth.isLoggedIn, (newValue) => {
  auth.value = newValue;
});

// Udsend en event ved klik på et modul
const emit = defineEmits<{
  (event: 'onSelect', moduleName: string): void;
}>();
</script>

<template>
  <div class="flex flex-col h-full">
    <h3 class="text-lg text-center font-semibold mb-4">Modules</h3>
    <div class="grid grid-cols-2 gap-4 flex-1 overflow-auto">
      <!-- Dynamisk genererede moduler -->
      <div
        v-for="module in modules"
        :key="module.name"
        class="flex flex-col items-center cursor-pointer bg-gray-200 rounded-lg shadow hover:bg-gray-300 transition-colors"
        style="width: 142.5px; height: 142.5px;"
        @click="emit('onSelect', module.name)"
      >
        <img
          :src="module.image"
          :alt="module.name"
          class="w-full h-full object-cover rounded-lg"
        />
        <span class="text-sm font-medium">{{ module.name }}</span>
      </div>
    </div>

    <!-- Faste knapper nederst -->
    <div v-if="auth" class="flex justify-between items-center p-4 bg-white">
      <button
        class="px-4 py-2 bg-black text-white rounded-md hover:bg-white hover:text-black transition border"
      >
        Add to Cart
      </button>
      <button
        class="px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400 transition"
      >
        Save & Share
      </button>
    </div>
    <div v-if="!auth" class="flex justify-between items-center p-4 bg-white">
      <div class="">Login to purchase</div>
      <button
        class="px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-gray-400 transition"
      >
        Save & Share
      </button>
    </div>
  </div>
</template>



