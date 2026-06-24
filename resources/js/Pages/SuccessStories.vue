<script setup>
import { Head, Link } from '@inertiajs/vue3'
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'

defineProps({
    stories: Array,
    seo: Object,
})

const getImage = (image) => {
    if (!image) return null
    if (/^https?:\/\//.test(image)) return image
    return `https://app.wabepoint.com/${image.replace(/^\/+/, '')}`
}
</script>

<template>
    <Head>
        <title>{{ seo?.title || 'Success Stories - WabePoint POS' }}</title>
        <meta name="description" :content="seo?.description" />
    </Head>

    <div class="min-h-screen bg-gray-50">
        <Navigation :canLogin="true" :canRegister="true" />

        <section class="relative bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] text-white py-20">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold">Success Stories</h1>
                <p class="mt-3 text-white/70 text-lg">See how businesses across Kenya are growing with WabePoint</p>
            </div>
        </section>

        <section class="py-16">
            <div class="max-w-5xl mx-auto px-4">
                <div v-if="stories.length === 0" class="text-center py-12">
                    <p class="text-gray-400 text-lg">No success stories yet. Check back soon!</p>
                </div>
                <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="story in stories" :key="story.id" class="bg-white rounded-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                        <img v-if="getImage(story.image)" :src="getImage(story.image)" :alt="story.name" class="w-full h-44 object-cover" />
                        <div class="p-6">
                            <h3 class="font-bold text-gray-900 text-base mb-2">{{ story.name }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">{{ story.description || story.content }}</p>
                            <Link :href="route('blogs.show', story.slug)" class="mt-4 inline-flex items-center text-sm font-semibold text-[#2596be] hover:text-[#1a6d8a] transition-colors">
                                Read Story
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>
