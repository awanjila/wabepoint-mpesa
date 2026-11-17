<script setup>
import IndustryVisual from '@/Components/IndustryVisual.vue';

const props = defineProps({
    industry: Object,
});
</script>

<template>
    <section class="bg-white py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-sm border-2 border-[#e5e7eb] aspect-video">
                <IndustryVisual
                    :image="industry.media?.image"
                    :video="industry.media?.video"
                    :label="industry.label"
                />
            </div>
        </div>
    </section>
</template>
