<script lang="ts" setup>
import ModuleMenu from '../../Components/ModuleMenu.vue'
import { onMounted, ref, computed, onUnmounted } from 'vue';
import { Crafter } from '@/System/Crafter';
import { LoopOnce, AnimationClip } from 'three';

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
const isMinimized = ref(true);
const windowWidth = ref(window.innerWidth);
let crafter: Crafter;

const handleResize = () => {
  windowWidth.value = window.innerWidth;
};

onMounted(() => {
  window.addEventListener('resize', handleResize);
  if (configurator.value) {
    crafter = new Crafter(configurator.value);
    crafter.engine.sceneSetup.initialize(3);
    crafter.engine.loader.loadModel(props.model.uri).then(({ model, animations }) => {
      crafter.engine.scene.add(model);

      if (animations.length > 0) {
        crafter.engine.animation.addAnimation(model);
      }
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

const changeVariant = (variantName: string) => {
  const object = crafter.engine.getObjectByIdentifier(props.model.uri);
  crafter.engine.camera.position.set(-1.05, -0.27, 1);
  crafter.engine.orbitControls.target.set(-1, -0.3, 0.3);
  crafter.engine.camera.lookAt(-1, -0.3, 0.3)

  if (object) {
    const animations = crafter.engine.animation;

    // Start animationen og skift varianten efter 500ms
    animations.playAnimation(object, () => {
      crafter.engine.loader.selectVariant(object, variantName);
    });
  } else {
    console.warn('Model not found for variant change:', props.model.uri);
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

        <!-- Module Menu -->
        <ModuleMenu
          :modules="modules"
          @onSelect="changeVariant"
        ></ModuleMenu>
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
