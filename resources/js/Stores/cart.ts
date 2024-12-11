import { defineStore } from 'pinia';

export interface CartItem {
  id: number; // Variant ID
  variant_name: string;
  image_path: string;
  price: number;
  quantity: number;
}

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [] as CartItem[], // Array af cart_items
  }),
  actions: {
    addToCart(item: CartItem) {
      const existingItem = this.items.find((i) => i.id === item.id);
      if (existingItem) {
        // Opdater mængde, hvis varianten allerede er i kurven
        existingItem.quantity += item.quantity;
      } else {
        // Tilføj ny variant til kurven
        this.items.push(item);
      }
    },
    removeFromCart(itemId: number) {
      this.items = this.items.filter((item) => item.id !== itemId);
    },
    updateQuantity(itemId: number, quantity: number) {
      const item = this.items.find((i) => i.id === itemId);
      if (item) {
        item.quantity = quantity;
      }
    },
    clearCart() {
      this.items = [];
    },
  },
  getters: {
    totalItems(state): number {
      return state.items.reduce((total, item) => total + item.quantity, 0);
    },
    totalPrice(state): number {
      return state.items.reduce((total, item) => total + item.price * item.quantity, 0);
    },
  },
});
