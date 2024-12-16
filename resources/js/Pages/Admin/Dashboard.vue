<script setup lang="ts">
import { Variants } from '@/System/Entities';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification';

// Props med varianter
const props = defineProps<{
    variants: Variants[];
}>();

// Toast beskeder
const toast = useToast();

// Lokal kopi af varianterne for redigering
const localVariants = ref([...props.variants]);

// Håndter opdatering af prisen
const updatePrice = async (variantId: number, newPrice: number) => {
    try {
        if (newPrice < 0) {
            toast.error('Price cannot be negative.');
            return;
        }

        // Send opdateret pris til serveren
        await axios.post(`/admin/products/${variantId}`, {
            price: newPrice,
        });

        toast.success('Price updated successfully!');
    } catch (error) {
        toast.error(error.response?.data?.message || 'Failed to update price.');
    }
};
</script>

<template>
    <AdminLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6 text-center">All Products</h1>

            <!-- Produkter tabel -->
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Image</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Variant Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="variant in localVariants"
                        :key="variant.id"
                        class="hover:bg-gray-50"
                    >
                        <td class="border border-gray-300 px-4 py-2">{{ variant.id }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <img
                                :src="variant.image_path"
                                :alt="variant.variant_name"
                                class="w-16 h-16 object-cover rounded"
                            />
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ variant.variant_name }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input
                                type="number"
                                class="w-full px-2 py-1 border border-gray-300 rounded"
                                v-model.number="variant.product.price"
                            />
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <button
                                class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-500"
                                @click="updatePrice(variant.product.id, variant.product.price)"
                            >
                                Save
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>



