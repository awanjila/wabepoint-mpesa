<script setup>
defineProps({
    industry: Object,
});
</script>

<template>
    <section class="bg-white py-16 border-t border-[#e5e7eb]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4">About {{ industry.name }}</h2>
            <p class="text-gray-700 leading-relaxed">{{ industry.about }}</p>

            <ul v-if="industry.search_terms && industry.search_terms.length" class="mt-6 flex flex-wrap gap-2" aria-label="Related searches">
                <li
                    v-for="term in industry.search_terms"
                    :key="term"
                    class="px-3 py-1 text-xs font-semibold bg-[#2596be]/10 text-[#2596be] rounded-sm border border-[#2596be]/20"
                >
                    {{ term }}
                </li>
            </ul>
        </div>
    </section>
</template>
