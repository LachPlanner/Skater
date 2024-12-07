<script setup lang="ts">
import BoxInformation from '../Components/BoxInformation.vue';
import Carousel from '@/Components/Carousel.vue';
</script>

<template>
  <Layout>
    <div class="flex flex-col min-h-screen">
      
      <div class="w-full h-full max-h-[700px] mb-6">
        <Carousel />
      </div>
    
      <div class="flex items-center justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <BoxInformation href="/editor" title="Editors Bay" description="Click here if you wanna try the 3D environment on my website"></BoxInformation>
          <BoxInformation href="https://threejs.org/docs/" title="Three Js" description="Click here if you wanna learn more about Three Js in their documentation."></BoxInformation>
          <BoxInformation href="https://vuejs.org/guide/introduction.html" title="Vue" description="Click here if you wanna learn more about Vue in their documentation."></BoxInformation>
          <BoxInformation href="https://laravel.com/docs/11.x/readme" title="Laravel" description="Click here if you wanna learn more about Laravel in their documentation."></BoxInformation>
        </div>
      </div>
    </div>
  </Layout>
</template>