<script lang="ts" setup>
import ModuleMenu from '../../Components/ModuleMenu.vue'
import { onMounted, ref, computed } from 'vue';
import { Crafter } from '@/System/Crafter';

const props = defineProps<{
  model: {
    uri: string;
    variants: Array<{
      variant_name: string;
      variant_index: number;
      image_path: string;
    }>;
  };
}>();

const modules = computed(() => {
  return props.model.variants.map(variant => ({
    name: variant.variant_name,
    image: variant.image_path,
  }));
});

const configurator = ref();

let crafter: Crafter;

onMounted(() => {
  if (configurator.value) {
    crafter = new Crafter(configurator.value);
    crafter.engine.initialize();
    crafter.engine.loader.loadModel(props.model.uri);
    crafter.engine.camera.updateCameraPosition(-1, -0.3, 1);
    crafter.engine.camera.updateCameraTarget(-1, -0.3, 0.3);
    crafter.engine.orbitControls.updateTarget(-1, -0.3, 0.3);
    crafter.engine.orbitControls.updateAzimuthAngle(45 * (Math.PI / 180));
    crafter.engine.animate();
  }
});

const changeVariant = (variantName: string) => {
  // Use the model identifier to find the object
  const object = crafter.engine.getObjectByIdentifier(props.model.uri);
  
  if (object) {
    // Change the variant using the loader's selectVariant method
    crafter.engine.loader.selectVariant(object, variantName);
    console.log(`Variant "${variantName}" applied to model.`);
  } else {
    console.warn(`Model with identifier "${props.model.uri}" not found.`);
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
        class="absolute top-4 right-4 w-[366px] h-[calc(100%-2rem)] bg-white p-6 border border-gray-300 overflow-y-auto shadow-lg"
      >
        <!-- Module Menu -->
        <ModuleMenu
          :modules="modules"
          @onSelect="changeVariant"
        ></ModuleMenu>
      </aside>
    </div>
  </Layout>
</template>