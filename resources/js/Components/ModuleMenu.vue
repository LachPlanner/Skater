<script lang="ts" setup>
// Definér typen for et modul
interface Module {
  name: string;
  image: string;
}

// Definér props med TypeScript
defineProps<{
  modules: Module[]; // Liste af moduler
}>();
</script>

<template>
  <div>
    <h3 class="text-lg text-center font-semibold mb-4">Modules</h3>
    <div class="grid grid-cols-2 gap-4">
      <!-- Dynamisk genererede moduler -->
      <div
        v-for="module in modules"
        :key="module.name"
        class="flex flex-col items-center"
      >
        <img
          :src="module.image"
          :alt="module.name"
          class="shadow"
        />
        <span class="mt-2 text-sm font-medium">{{ module.name }}</span>
      </div>
    </div>
  </div>
</template>

