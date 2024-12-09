<script setup lang="ts">
import TabMenu from '@/Components/TabMenu.vue';
import { Crafter } from '@/System/Crafter';
import { ref, onMounted } from 'vue';

const props = defineProps<{
  models: Array<{
    id: number;
    uri: string;
    variants: Array<{
      variant_name: string;
      variant_index: number;
      image_path: string;
    }>;
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

const changeVariant = (variantName: string, modelUri: string) => {
  console.log(`Selected module: ${variantName}, Model URI: ${modelUri}`);
  const object = crafter.engine.getObjectByIdentifier(modelUri);
  if(object) {
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
          @onSelect="changeVariant"
        />
      </aside>
    </div>
  </Layout>
</template>


  
  