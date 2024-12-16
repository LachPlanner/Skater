<script setup lang="ts">
import { ref } from 'vue';
import { CartItem, CartProps } from '@/System/Entities';
import { removeFromCart } from '@/Api/cart';
import LinkButton from '@/Components/LinkButton.vue';
import { useToast } from 'vue-toastification';

const toast = useToast();

// Definer props
const props = defineProps<CartProps>();

// Lokal reaktiv tilstand til cartItems og totalPrice
const cartItems = ref<CartItem[]>(props.cartItems);
const totalPrice = ref<number>(props.totalPrice);

// Fjern et produkt fra kurven
const handleRemoveFromCart = async (productId: number) => {
    try {
        const updatedCart = await removeFromCart(productId);
        cartItems.value = cartItems.value.filter(item => item.product_id !== productId);
        totalPrice.value = updatedCart.reduce(
            (sum, item) => sum + item.price * item.quantity,
            0
        );
        toast.success('Succesfully removed item from cart')
    } catch (error) {
        toast.error('Could not remove item. Please try again.');
    }
};
</script>

<template>
  <Layout>
    <div class="container mx-auto p-6 h-auto">
      <h1 class="text-3xl font-bold text-center mb-8">Your Shopping Cart</h1>

      <!-- Responsiv grid layout -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 bg-white p-6">
        <!-- Venstre sektion: Cart Items -->
        <div>
          <h2 class="text-xl font-semibold mb-4 text-center">Cart Items</h2>
          <div v-if="cartItems.length" class="space-y-4">
            <div
              v-for="item in cartItems"
              :key="item.id"
              class="flex items-center border p-4 rounded shadow-sm"
            >
              <img
                :src="item.product.variant.image_path"
                :alt="item.product.variant.variant_name"
                class="w-16 h-16 object-cover rounded mr-4"
              />
              <div class="flex-1">
                <h2 class="text-lg font-medium">{{ item.product.variant.variant_name }}</h2>
                <p class="text-gray-600">Quantity: {{ item.quantity }}</p>
                <p class="text-gray-600">Price: {{ item.price }} DKK</p>
              </div>
              <button
                @click="handleRemoveFromCart(item.product_id)"
                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
              >
                Remove
              </button>
            </div>
          </div>
          <div v-else class="flex flex-col items-center mt-12">
            <p class="text-gray-600 mb-12">Your cart is empty.</p>
            <LinkButton
              href="/shop"
              class="px-4 py-2"
            >
              Go to Shop
            </LinkButton>
          </div>

          <!-- Totalpris -->
          <div v-if="cartItems.length" class="mt-6 pt-4 border-t border-gray-300">
            <h3 class="text-lg font-medium text-center">Total: {{ totalPrice }} DKK</h3>
          </div>
        </div>

        <!-- Højre sektion: Shipping Information -->
        <div>
          <h2 class="text-xl font-semibold mb-4 text-center">Shipping Information</h2>
          <form class="space-y-4">
            <div>
              <label for="firstName" class="block text-sm font-medium">First Name</label>
              <input
                id="firstName"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label for="lastName" class="block text-sm font-medium">Last Name</label>
              <input
                id="lastName"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label for="address" class="block text-sm font-medium">Address</label>
              <input
                id="address"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label for="city" class="block text-sm font-medium">City</label>
              <input
                id="city"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label for="zip" class="block text-sm font-medium">Postal Code</label>
              <input
                id="zip"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <button
              v-if="cartItems.length"
              type="submit"
              class="w-full px-4 py-2 bg-black text-white rounded hover:bg-gray-800"
            >
              Complete Order
            </button>
            <button
              v-else
              type="submit"
              class="w-full px-4 py-2 bg-gray-200 text-white rounded"
              disabled="true"
            >
            Complete Order
            </button>
          </form>
        </div>
      </div>
    </div>
  </Layout>
</template>

  


