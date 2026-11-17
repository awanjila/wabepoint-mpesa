<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import IndustryVisual from '@/Components/IndustryVisual.vue';

const props = defineProps({
    heading: { type: Boolean, default: true },
});

const industries = computed(() => usePage().props.industries);
const track = ref(null);

function slide(direction) {
    const el = track.value;
    if (!el) return;

    const card = el.querySelector('a');
    const step = card ? card.offsetWidth + 16 : el.clientWidth;
    const atEnd = el.scrollLeft + el.clientWidth >= el.scrollWidth - 4;
    const atStart = el.scrollLeft <= 4;

    if (direction > 0 && atEnd) {
        el.scrollTo({ left: 0, behavior: 'auto' });
    } else if (direction < 0 && atStart) {
        el.scrollTo({ left: el.scrollWidth, behavior: 'auto' });
    } else {
        el.scrollBy({ left: direction * step, behavior: 'auto' });
    }
}
</script>

<template>
    <div :class="heading ? 'bg-white py-16' : ''">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div v-if="heading" class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Point of Sale for Every Business</h2>
                <p class="mt-2 text-gray-600">Select an industry to see how WabePoint works for it</p>
            </div>

            <div class="relative">
                <div
                    ref="track"
                    class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-2"
                    style="scrollbar-width: none;"
                >
                    <a
                        v-for="item in industries"
                        :key="item.id"
                        :href="item.path"
                        class="group snap-start shrink-0 w-[80%] sm:w-[calc(50%-0.5rem)] lg:w-[calc(20%-0.8rem)] bg-white rounded-sm overflow-hidden border-2 border-[#e5e7eb] hover:border-[#2596be] hover:shadow-md transition-all duration-150"
                    >
                        <div class="relative aspect-[4/3] bg-[#f3f4f6]">
                            <IndustryVisual
                                :image="item.cover"
                                :video="item.video"
                                :label="item.label"
                            />
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide group-hover:text-[#2596be] transition-colors">Point of Sale for {{ item.label }}</h3>
                            <p class="mt-1 text-xs text-gray-600 leading-relaxed">{{ item.summary }}</p>
                        </div>
                    </a>
                </div>

                <button @click="slide(-1)" aria-label="Previous industries" class="absolute -left-2 lg:-left-5 top-1/3 w-10 h-10 bg-white border-2 border-[#e5e7eb] rounded-sm flex items-center justify-center text-gray-700 hover:border-[#2596be] hover:text-[#2596be] transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button @click="slide(1)" aria-label="Next industries" class="absolute -right-2 lg:-right-5 top-1/3 w-10 h-10 bg-white border-2 border-[#e5e7eb] rounded-sm flex items-center justify-center text-gray-700 hover:border-[#2596be] hover:text-[#2596be] transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</template>
