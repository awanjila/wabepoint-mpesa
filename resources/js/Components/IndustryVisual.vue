<script setup>
import { computed } from 'vue';

const props = defineProps({
    image: { type: String, default: null },
    video: { type: String, default: null },
    label: { type: String, default: 'business' },
});

const embedUrl = computed(() =>
    props.video
        ? `https://www.youtube-nocookie.com/embed/${props.video}?rel=0&modestbranding=1`
        : null
);
</script>

<template>
    <div class="relative w-full h-full overflow-hidden bg-[#f3f4f6]">
        <img
            v-if="image"
            :src="image"
            :alt="`WabePoint point of sale in use at a ${label.toLowerCase()} in Kenya`"
            class="w-full h-full object-cover"
            loading="lazy"
        />
        <iframe
            v-else-if="video"
            :src="embedUrl"
            :title="`WabePoint point of sale demo for ${label.toLowerCase()}`"
            class="w-full h-full"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
        <img
            v-else
            src="/assets/images/logo/logo.png"
            alt="WabePoint"
            class="w-full h-full object-contain p-6"
            loading="lazy"
        />
    </div>
</template>
