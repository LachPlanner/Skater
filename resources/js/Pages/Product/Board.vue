<script lang="ts" setup>
import ModuleMenu from '../../Components/ModuleMenu.vue'
import { Crafter } from '@/System/Crafter';
import { onMounted } from 'vue';

const modules = [
  { name: 'Model1', image: 'https://via.placeholder.com/100' },
  { name: 'Model2', image: 'https://via.placeholder.com/100' },
  { name: 'Model3', image: 'https://via.placeholder.com/100' },
  { name: 'Model4', image: 'https://via.placeholder.com/100' },
  { name: 'Model5', image: 'https://via.placeholder.com/100' },
  { name: 'Model6', image: 'https://via.placeholder.com/100' },
];

let crafter: Crafter;

onMounted(async () => {
  const container = document.getElementById('canvas') as HTMLElement;

  if (container) {
    crafter = Crafter.getInstance(container);

    // Load model
    try {
      await new Promise<void>((resolve, reject) => {
        crafter.engine.loadModel('/storage/models/board.glb', (model) => {
          console.log('Model loaded:', model);
          resolve();
        });
      });
    } catch (error) {
      console.error('Failed to load model:', error);
    }
  } else {
    console.error('Container element not found.');
  }
});
</script>

<template>
  <Layout :withPadding="false">
    <div class="relative h-[calc(100vh-4.6rem)] bg-gray-100">
      <!-- Three.js Canvas -->
      <canvas id="canvas" class="w-full h-full absolute inset-0"></canvas>
  
      <!-- Menu -->
      <aside
        class="absolute top-4 right-4 w-[366px] h-[calc(100%-2rem)] bg-white p-6 border border-gray-300 overflow-y-auto shadow-lg"
      >
        <!-- Content Section -->
        <ModuleMenu :modules="modules"></ModuleMenu>
      </aside>
    </div>
  </Layout>
</template>
  
  