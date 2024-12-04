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

// Udsend en event ved klik på et modul
const emit = defineEmits<{
  (event: 'onSelect', moduleName: string): void;
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
        class="flex flex-col items-center cursor-pointer bg-gray-200 rounded-lg shadow hover:bg-gray-300 transition-colors"
        style="width: 142.5px; height: 142.5px;"
        @click="emit('onSelect', module.name)"
      >
        <img
          :src="module.image"
          :alt="module.name"
          class="w-full h-full object-cover rounded-lg"
        />
        <span class=" text-sm font-medium">{{ module.name }}</span>
      </div>
    </div>
  </div>
</template>


