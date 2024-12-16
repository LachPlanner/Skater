<script lang="ts" setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Variants } from '@/System/Entities';
import { useCartStore } from '@/Stores/cart';

// Props med modeller
const props = defineProps<{
  models: Array<{
    id: number;
    uri: string;
    variants: Array<Variants>;
  }>;
}>();

// Hent loginstatus
const page = usePage<{ auth: { isLoggedIn: boolean } }>();
const auth = computed(() => page.props.auth.isLoggedIn);

// Aktiv tab
const activeTab = ref<'Board'|'Truck'|'Wheels'>('Board');

// Find den aktive model baseret på aktiv tab
const activeModelUri = computed(() => {
  if (activeTab.value === 'Board') return props.models.find(model => model.id === 1)?.uri;
  if (activeTab.value === 'Truck') return props.models.find(model => model.id === 3)?.uri;
  if (activeTab.value === 'Wheels') return props.models.find(model => model.id === 5)?.uri;
  return null;
});

// Dynamisk indhold baseret på aktiv tab
const currentModules = computed(() => {
  if (activeTab.value === 'Board') return props.models.find(model => model.id === 1)?.variants || [];
  if (activeTab.value === 'Truck') return props.models.find(model => model.id === 3)?.variants || [];
  if (activeTab.value === 'Wheels') return props.models.find(model => model.id === 5)?.variants || [];
  return [];
});

// Emit event ved modulvalg
const emit = defineEmits<{
  (event: 'onSelect', moduleName: string, modelUri: string): void;
  (event: 'onTabChange', tabName: string): void;
}>();
 
// Skift tab
const switchTab = (tab: string) => {
  activeTab.value = tab;
  emit('onTabChange', tab);
};

// Klik på modul
const selectModule = (moduleName: string) => {
  if (activeModelUri.value) {
    emit('onSelect', moduleName, activeModelUri.value);
  }
};
</script>

<template>
  <div class="flex flex-col h-full">
    <!-- Tabs -->
    <div class="flex justify-center space-x-4 border-b bg-white p-2 shadow">
      <button
        v-for="tab in ['Board', 'Truck', 'Wheels']"
        :key="tab"
        @click="switchTab(tab)"
        :class="{
          'border-b-2 border-black font-bold': activeTab === tab,
          'text-gray-500': activeTab !== tab,
        }"
        class="px-4 py-2 transition hover:text-black"
      >
        {{ tab }}
      </button>
    </div>

    <!-- Dynamisk indhold -->
    <div class="grid grid-cols-2 gap-4 flex-1 overflow-auto mt-4">
      <div
        v-for="module in currentModules"
        :key="module.variant_name"
        class="flex flex-col items-center cursor-pointer bg-gray-200 rounded-lg shadow hover:bg-gray-300 transition-colors"
        style="width: 142.5px; height: 142.5px;"
        @click="selectModule(module.variant_name)"
      >
        <img
          :src="module.image_path"
          :alt="module.variant_name"
          class="w-full h-full object-cover rounded-lg"
        />
        <span class="text-sm font-medium">{{ module.variant_name }}</span>
      </div>
    </div>

    <!-- Faste knapper nederst -->
    <div class="flex justify-center items-center p-4 bg-white">
      <Link
        href="/shop"
        class="px-4 py-2 bg-black text-white rounded-md hover:bg-white hover:text-black transition border"
      >
        Go To Shop
      </Link>
    </div>
  </div>
</template>
  


