<script setup lang="ts">
import { ref, computed } from 'vue';
import { useCartStore } from '@/Stores/cart';
import { Variants } from '@/System/Entities';

// Props for varianter
const props = defineProps<{
  variants: Array<Variants>;
}>();

// Aktive tab
const activeTab = ref('Board');

// Map model_id til tabs
const modelMap = {
  Board: 1,
  Trucks: 3,
  Wheels: 5,
};

// Søgefelt
const searchQuery = ref('');

// Filtrer varianter baseret på aktiv tab og søgefelt
const filteredVariants = computed(() => {
  const currentVariants = props.variants.filter(
    (variant) => variant.model_id === modelMap[activeTab.value]
  );

  if (!searchQuery.value) {
    return currentVariants;
  }

  const query = searchQuery.value.toLowerCase();
  return currentVariants.filter((variant) =>
    variant.variant_name.toLowerCase().includes(query)
  );
});

// Kurv store
const cartStore = useCartStore();

// Popup State
const showPopup = ref(false);
const selectedVariant = ref<Variants | null>(null);

// Åben popup
const openPopup = (variant: Variants) => {
  selectedVariant.value = variant;
  showPopup.value = true;
};

// Luk popup
const closePopup = () => {
  showPopup.value = false;
  selectedVariant.value = null;
};

// Tilføj til kurv
const addToCart = (variant: Variants) => {
  cartStore.addToCart({ ...variant, quantity: 1 });
  closePopup();
  console.log('Added to cart:', variant);
};
</script>

<template>
    <Layout>
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Product Selection</h1>
        
            <!-- Søgefelt -->
            <div class="mb-4 flex justify-center">
                <input
                v-model="searchQuery"
                type="text"
                placeholder="Search variants..."
                class="w-full max-w-md px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
        
            <!-- Tabs Navigation -->
            <div class="flex justify-center space-x-4 border-b-2 pb-2 mb-4">
                <button
                v-for="tab in ['Board', 'Trucks', 'Wheels']"
                :key="tab"
                @click="activeTab = tab"
                :class="{
                    'border-b-4 border-black font-bold': activeTab === tab,
                    'text-gray-500': activeTab !== tab,
                }"
                class="px-4 py-2"
                >
                {{ tab }}
                </button>
            </div>
        
            <!-- Variants Display -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div
                v-for="variant in filteredVariants"
                :key="variant.id"
                class="p-2 bg-white border border-gray-200 shadow-sm rounded cursor-pointer"
                @click="openPopup(variant)"
                >
                <img
                    :src="variant.image_path"
                    :alt="variant.variant_name"
                    class="w-full h-32 object-cover rounded mb-2"
                />
                <h2 class="text-sm font-medium mb-1">{{ variant.variant_name }}</h2>
                <p class="text-sm text-gray-600 mb-2">{{ variant.price }} DKK</p>
                <button
                    class="w-full px-3 py-2 bg-black text-white rounded hover:bg-gray-800"
                    @click="addToCart(selectedVariant)"
                >
                    Add to Cart
                </button>
                </div>
            </div>
        
            <!-- Popup -->
            <div
                v-if="showPopup"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            >
                <div class="bg-white p-6 w-[90%] max-w-md rounded shadow-lg relative">
                <button
                    class="absolute top-2 right-2 text-gray-500 hover:text-black"
                    @click="closePopup"
                >
                    ✕
                </button>
                <img
                    :src="selectedVariant.image_path"
                    :alt="selectedVariant.variant_name"
                    class="w-full h-40 object-cover rounded mb-4"
                />
                <h2 class="text-xl font-bold">{{ selectedVariant.variant_name }}</h2>
                <p class="text-gray-600 mb-4">{{ selectedVariant.price }} DKK</p>
                <button
                    class="w-full px-3 py-2 bg-black text-white rounded hover:bg-gray-800"
                    @click="addToCart(selectedVariant)"
                >
                    Add to Cart
                </button>
                </div>
            </div>
        </div>
    </Layout>
  </template>

