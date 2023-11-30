<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-600 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-teal-800 focus:ring-offset-1 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
