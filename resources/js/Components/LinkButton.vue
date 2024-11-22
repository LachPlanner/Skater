<script lang="ts" setup>
defineProps({
    href: String
});
</script>

<template>
    <Link
        :href = href 
        class="inline-flex items-center px-2 py-2 bg-black border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-white hover:text-black active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
        <slot/>
    </Link>
</template>