<script lang="ts" setup>
import ModuleMenu from '../../Components/ModuleMenu.vue'
import { onMounted, ref } from 'vue';
import { Crafter } from '@/System/Crafter';

const modules = [
  { name: 'Model1', image: 'https://via.placeholder.com/100' },
  { name: 'Model2', image: 'https://via.placeholder.com/100' },
  { name: 'Model3', image: 'https://via.placeholder.com/100' },
  { name: 'Model4', image: 'https://via.placeholder.com/100' },
  { name: 'Model5', image: 'https://via.placeholder.com/100' },
  { name: 'Model6', image: 'https://via.placeholder.com/100' },
];

const configurator = ref();

let crafter: Crafter;

onMounted(() => {
  crafter = new Crafter(configurator.value);
  crafter.engine.initialize();
  crafter.engine.loadModel('wheels');
  crafter.engine.render();
});
</script>

<template>
    <Layout :withPadding="false">
      <div class="relative h-[calc(100vh-4.6rem)] bg-gray-100">
        <!-- Three.js Canvas -->
        <div id="canvas" ref="configurator" class="w-full h-full absolute inset-0"></div>
  
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