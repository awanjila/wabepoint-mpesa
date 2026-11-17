<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    current: String,
});

const others = computed(() =>
    usePage().props.industries.filter((industry) => industry.slug !== props.current)
);
</script>

<template>
    <section class="bg-[#f3f4f6] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Other Industries We Serve</h2>
                <p class="mt-2 text-gray-600">WabePoint runs point of sale for businesses across Kenya</p>
            </div>

            <nav aria-label="Other industries" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a
                    v-for="item in others"
                    :key="item.id"
                    :href="item.path"
                    class="bg-white rounded-sm border-2 border-[#e5e7eb] hover:border-[#2596be] hover:shadow-md p-5 text-center transition-all duration-150"
                >
                    <span class="text-sm font-bold text-gray-900 uppercase tracking-wide">Point of Sale for {{ item.label }}</span>
                </a>
            </nav>
        </div>
    </section>
</template>
