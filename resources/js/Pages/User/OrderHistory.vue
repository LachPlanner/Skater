<script setup lang="ts">
import { ref } from 'vue';
import { Order } from '@/System/Entities';

// Hent ordrer fra props
defineProps<{
  orders: Order[];
}>();

// Reaktiv tilstand for at holde styr på den valgte ordre
const expandedOrderId = ref<number | null>(null);

// Håndter klik for at udfolde eller skjule en ordre
const toggleOrderDetails = (orderId: number) => {
  expandedOrderId.value = expandedOrderId.value === orderId ? null : orderId;
};
</script>

<template>
  <Layout>
    <div class="container mx-auto px-4 py-8">
      <h1 class="text-3xl font-bold mb-6 text-center">Order History</h1>

      <!-- Ordrer -->
      <div v-if="orders.length" class="space-y-6">
        <div
          v-for="order in orders"
          :key="order.id"
          class="bg-white shadow-md rounded-md"
        >
          <!-- Ordreoverskrift -->
          <div
            class="flex justify-between items-center border-b pb-4 p-6 cursor-pointer"
            @click="toggleOrderDetails(order.id)"
          >
            <div>
              <p class="text-gray-600">Order ID: {{ order.id }}</p>
              <p class="text-gray-600">
                Date: {{ new Date(order.order_date).toLocaleDateString() }}
              </p>
            </div>
            <h2 class="text-lg font-semibold">Total: {{ order.total_amount }} DKK</h2>
          </div>

          <!-- Udfoldet ordreindhold -->
          <div v-if="expandedOrderId === order.id" class="p-6 space-y-4">
            <div
              v-for="item in order.items"
              :key="item.id"
              class="flex items-center border p-4 rounded-md"
            >
              <img
                v-if="item.product && item.product.variant"
                :src="item.product.variant.image_path"
                :alt="item.product.variant.variant_name"
                class="w-16 h-16 object-cover rounded mr-4"
              />
              <div>
                <h3 v-if="item.product && item.product.variant" class="text-lg font-medium">
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
        <p class="text-gray-600 mb-10">You have no orders.</p>
        <a href="/shop" class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
          Go to Shop
        </a>
      </div>
    </div>
  </Layout>
</template>


