<script lang="ts" setup>
import ModuleMenu from '../../Components/ModuleMenu.vue'
import { Crafter } from '@/System/Crafter';
import { onMounted, ref, computed } from 'vue';

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
    crafter.engine.loader.loadModel("LayingBoardWithVariants");
    crafter.engine.loader.loadModel("TruckWithVariants");
    crafter.engine.loader.loadModel("WheelsWithVariants");

    // Load the model with the identifier
    // crafter.engine.loader.loadModel(props.model.uri).then((model) => {
    //   console.log("Model loaded:", model);
    // });

    crafter.engine.animate();
  }
});

// Function to handle variant change
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
  
      
    </div>
  </Layout>
</template>

  
  