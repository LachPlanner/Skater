<script setup lang="ts">
import TabMenu from '@/Components/TabMenu.vue';
import { Crafter } from '@/System/Crafter';
import { ref, onMounted } from 'vue';
import { Variants } from '@/System/Entities';

const props = defineProps<{
  models: Array<{
    id: number;
    uri: string;
    variants: Array<Variants>;
  }>;
}>();

const configurator = ref();
let crafter: Crafter;

onMounted(() => {
  if (configurator.value) {
    crafter = new Crafter(configurator.value);
    crafter.engine.initialize(4);
    props.models.forEach(model => {
      crafter.engine.loader.loadModel(model.uri);
    });
    crafter.engine.animate();
  }
});

const updateCameraForTab = (tab: string) => {
  if (!crafter) return;

  switch (tab) {
    case 'Board':
      crafter.engine.camera.position.set(0, -3, 0);
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

// Håndter tab skift event
const handleTabChange = (tab: string) => {
  updateCameraForTab(tab);
};

// Håndter variantvalg
const changeVariant = (variantName: string, modelUri: string) => {
  console.log(`Selected module: ${variantName}, Model URI: ${modelUri}`);
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

      <aside
        class="absolute top-4 right-4 w-[366px] h-[calc(100%-2rem)] bg-white p-6 border border-gray-300 overflow-y-auto shadow-lg"
      >
        <TabMenu
          :models="props.models"
          @onSelect="(moduleName, modelUri) => changeVariant(moduleName, modelUri)"
          @onTabChange="handleTabChange"
        />
      </aside>
    </div>
  </Layout>
</template>



  
  