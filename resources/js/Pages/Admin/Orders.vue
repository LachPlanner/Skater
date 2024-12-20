<script setup lang="ts">
import { ref } from 'vue';
import { Order } from '@/System/Entities';
import AdminLayout from '@/Layouts/AdminLayout.vue'

// Hent ordrer fra props
defineProps<{
    orders: Order[];
}>();

// Lokal state til foldning af ordrer
const expandedOrderId = ref<number | null>(null);

const toggleOrder = (orderId: number) => {
    expandedOrderId.value = expandedOrderId.value === orderId ? null : orderId;
};
</script>

<template>
    <AdminLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-6 text-center">Admin: All Orders</h1>

            <!-- Ordrer -->
            <div v-if="orders.length" class="space-y-6">
                <div
                    v-for="order in orders"
                    :key="order.id"
                    class="bg-white shadow-md rounded-md p-6"
                >
                    <div
                        class="flex justify-between items-center border-b pb-4 mb-4 cursor-pointer"
                        @click="toggleOrder(order.id)"
                    >
                        <div>
                            <p class="text-gray-600">Order ID: {{ order.id }}</p>
                            <p class="text-gray-600">
                                Date: {{ new Date(order.order_date).toLocaleDateString() }}
                            </p>
                            <!-- Address Information -->
                            <p class="text-gray-600">
                                Address: {{ order.address }}, {{ order.city }} {{ order.postal_code }}
                            </p>
                        </div>
                        <h2 class="text-lg font-semibold">Total: {{ order.total_amount }} DKK</h2>
                    </div>

                    <!-- Items -->
                    <div v-if="expandedOrderId === order.id" class="space-y-4">
                        <div
                            v-for="item in order.items"
                            :key="item.id"
                            class="flex items-center border p-4 rounded-md"
                        >
                            <img
                                :src="item.product.variant.image_path"
                                :alt="item.product.variant.variant_name"
                                class="w-16 h-16 object-cover rounded mr-4"
                            />
                            <div>
                                <h3 class="text-lg font-medium">
                                    {{ item.product.variant.variant_name }}
                                </h3>
                                <p class="text-gray-600">Quantity: {{ item.quantity }}</p>
                                <p class="text-gray-600">Price: {{ item.price }} DKK</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ingen ordrer -->
            <div v-else class="text-center">
                <p class="text-gray-600">No orders found.</p>
            </div>
        </div>
    </AdminLayout>
</template>
