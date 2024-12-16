<script setup lang="ts">
import BoxInformation from '../Components/BoxInformation.vue';
import Carousel from '@/Components/Carousel.vue';
</script>

<template>
  <Layout :withPadding="false">
    <div class="flex flex-col min-h-screen pb-6">
      
      <div class="w-full h-full max-h-[700px] mb-6">
        <Carousel />
      </div>
    
      <div class="flex items-center justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <BoxInformation href="/Shop" title="Shop" description="Check out the shop and see what we have to offer"></BoxInformation>
          <BoxInformation href="/board" title="Board" description="Check out the boards in 3D space"></BoxInformation>
          <BoxInformation href="/trucks" title="Trucks" description="Check out the trucks in a 3D space"></BoxInformation>
          <BoxInformation href="/wheels" title="Wheels" description="Check out the wheels in a 3D space"></BoxInformation>
        </div>
      </div>
    </div>
  </Layout>
</template>