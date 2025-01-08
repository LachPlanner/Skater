<script setup lang="ts">
import { ref, onMounted } from 'vue';

const currentSlide = ref(0);
const images = ref([
  'images/carousel/Board2Render.png',
  'images/carousel/Board5Render.png',
  'images/carousel/Board11Render.png',
  'images/carousel/Board15Render.png'
]);

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % images.value.length;
};

onMounted(() => {
  const interval = setInterval(nextSlide, 5000); // Skift slide hver 5. sekund
  return () => clearInterval(interval); // Rens intervallet når komponenten unmountes
});
</script>

<template>
  <div 
    class="relative w-full h-full max-h-[700px] overflow-hidden bg-gray-800 flex items-center justify-center"
    style="height: 100vh;">
    <!-- Carousel Images -->
    <div
      v-for="(image, index) in images"
      :key="index"
      class="absolute inset-0 transition-opacity duration-1000"
      :class="{ 'opacity-100': index === currentSlide, 'opacity-0': index !== currentSlide }"
      style="background-size: cover; background-position: center;"
      :style="{ backgroundImage: `url(${image})` }"
    ></div>

    <Link
      href="/buildboard"
      class="absolute bottom-6 left-6 bg-white text-black py-2 px-4 rounded-md shadow-lg hover:bg-gray-200"
    >
      Go Build Your Own Board
    </Link>
  </div>
</template>

<style scoped>
/* Hvis du vil have glatte overgange */
</style>
