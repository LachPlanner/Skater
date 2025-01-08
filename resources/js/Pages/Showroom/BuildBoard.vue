<script setup lang="ts">
import TabMenu from '@/Components/TabMenu.vue';
import { Crafter } from '@/System/Crafter';
import { ref, onMounted, onUnmounted } from 'vue';
import { Variants } from '@/System/Entities';

const props = defineProps<{
  models: Array<{
    id: number;
    uri: string;
    variants: Array<Variants>;
  }>;
}>();

const configurator = ref();
const isMinimized = ref(true); // Menuen starter som minimeret
const windowWidth = ref(window.innerWidth); // Spor vinduets bredde
let crafter: Crafter;

// Opdater vinduets bredde, når det ændres
const handleResize = () => {
  windowWidth.value = window.innerWidth;
};

onMounted(() => {
  window.addEventListener('resize', handleResize);

  if (configurator.value) {
    crafter = new Crafter(configurator.value);
    crafter.engine.sceneSetup.initialize(4);
    props.models.forEach(model => {
      crafter.engine.loader.loadModel(model.uri);
    });
    if(windowWidth.value > 640) {
      crafter.engine.camera.setViewOffset(
      crafter.engine.canvas.clientWidth,
      crafter.engine.canvas.clientHeight,
      158, 0,
      crafter.engine.canvas.clientWidth,
      crafter.engine.canvas.clientHeight
    );
    }
    crafter.engine.animate();
  }
});

onUnmounted(() => {
  window.removeEventListener('resize', handleResize);
});

const updateCameraForTab = (tab: string) => {
  if (!crafter) return;

  switch (tab) {
    case 'Board':
      crafter.engine.camera.position.set(0, -4, 0);
      crafter.engine.camera.lookAt(0, 0, 0);
      crafter.engine.orbitControls.target.set(0, 0, 0);
      break;

    case 'Truck':
      crafter.engine.camera.position.set(0, -0.1, 0.8);
      crafter.engine.camera.lookAt(-1, -0.1, 0);
      crafter.engine.orbitControls.target.set(-1, -0.1, 0);
      break;

    case 'Wheels':
      crafter.engine.camera.position.set(-1, -0.3, 1);
      crafter.engine.camera.lookAt(-1, -0.3, 0.3);
      crafter.engine.orbitControls.target.set(-1, -0.3, 0.3);
      break;
  }
  crafter.engine.orbitControls.update();
};

const handleTabChange = (tab: string) => {
  updateCameraForTab(tab);
};

const changeVariant = (variantName: string, modelUri: string) => {
  const object = crafter.engine.getObjectByIdentifier(modelUri);
  if (object) {
    crafter.engine.loader.selectVariant(object, variantName);
  }
};
</script>

<template>
  <Layout :withPadding="false">
    <div class="relative h-[calc(100vh-4.6rem)] bg-gray-100">
      <!-- Three.js Canvas -->
      <div id="canvas" ref="configurator" class="w-full h-full absolute inset-0"></div>

      <!-- Menu -->
      <aside
        class="absolute top-4 right-4 w-[366px] h-[calc(100%-2rem)] bg-white p-6 border border-gray-300 overflow-y-auto shadow-lg transition-all duration-300 rounded-lg"
        :class="{ 'hidden': isMinimized && windowWidth < 640 }"
      >
        <!-- Minimize Button (kun på mobil) -->
        <button
          v-if="windowWidth < 640"
          class="absolute top-2 right-2 bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300"
          @click="isMinimized = true"
        >
          −
        </button>

        <!-- Tab Menu -->
        <TabMenu
          :models="props.models"
          @onSelect="(moduleName, modelUri) => changeVariant(moduleName, modelUri)"
          @onTabChange="handleTabChange"
        />
      </aside>

      <!-- Maximize Button (kun på mobil) -->
      <button
        v-if="isMinimized && windowWidth < 640"
        class="fixed right-4 mt-2 bg-gray-200 rounded-full w-8 h-8 flex items-center justify-center hover:bg-gray-300 shadow-lg"
        @click="isMinimized = false"
      >
        +
      </button>
    </div>
  </Layout>
</template>