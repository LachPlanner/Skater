<script setup>
defineProps({
    title: String,
    description: String
});
</script>

<template>
  <a class="flex flex-col min-h-64 min-w-[86px] w-96 p-6 border rounded-md shadow-lg hover:scale-105 transition duration-300">
    <h1 class="font-bold text-xl">{{ title }}</h1>
    <span class="mt-10 p-3">{{ description }}</span>
  </a>
</template>


