<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
import Footer from '@/Components/Footer.vue';
import IndustryMedia from '@/Components/IndustryMedia.vue';
import OtherIndustries from '@/Components/OtherIndustries.vue';
import IndustryAbout from '@/Components/IndustryAbout.vue';
import IndustryCarousel from '@/Components/IndustryCarousel.vue';

const props = defineProps({
    seo: Object,
    industry: Object,
});

const openFaq = ref(null);
function toggleFaq(index) {
    openFaq.value = openFaq.value === index ? null : index;
}

const whatsappMessage = encodeURIComponent(`Hi, I'm interested in WabePoint POS for my ${props.industry.label.toLowerCase()}. I'd like to book a demo.`);
const whatsappUrl = `https://wa.me/254781312070?text=${whatsappMessage}`;

const faqSchema = computed(() =>
    JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'FAQPage',
        mainEntity: props.industry.faqs.map((faq) => ({
            '@type': 'Question',
            name: faq.question,
            acceptedAnswer: { '@type': 'Answer', text: faq.answer },
        })),
    })
);

const breadcrumbSchema = computed(() =>
    JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'BreadcrumbList',
        itemListElement: [
            { '@type': 'ListItem', position: 1, name: 'Home', item: 'https://wabepoint.com' },
            { '@type': 'ListItem', position: 2, name: props.industry.label, item: props.seo.canonical },
        ],
    })
);
</script>

<template>
    <Head>
        <title>{{ seo.title }}</title>
        <meta name="description" :content="seo.description" />
        <meta name="keywords" :content="seo.keywords" />
        <meta property="og:title" :content="seo.title" />
        <meta property="og:description" :content="seo.description" />
        <meta property="og:type" content="website" />
        <meta property="og:url" :content="seo.canonical" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="seo.title" />
        <meta name="twitter:description" :content="seo.description" />
        <link rel="canonical" :href="seo.canonical" />
        <script type="application/ld+json" v-html="faqSchema"></script>
        <script type="application/ld+json" v-html="breadcrumbSchema"></script>
    </Head>

    <div class="min-h-screen bg-[#f3f4f6] font-sans antialiased">
        <Navigation :canLogin="true" :canRegister="true" />

        <!-- ==================== HERO ==================== -->
        <section class="relative bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] text-white overflow-hidden">
            <div class="relative max-w-4xl mx-auto px-4 py-20 text-center">
                <span class="inline-block px-3 py-1 bg-[#2596be]/20 text-[#5ec4e8] text-xs font-bold uppercase tracking-widest rounded-sm mb-4 border border-[#2596be]/30">
                    {{ industry.eyebrow }}
                </span>
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight">{{ industry.name }}</h1>
                <p class="mt-4 text-lg font-bold uppercase tracking-wide text-[#5ec4e8]">
                    <span v-for="(line, i) in industry.headline" :key="i">{{ line }}<span v-if="i < industry.headline.length - 1"> </span></span>
                </p>
                <p class="mt-5 text-white/70 text-lg max-w-2xl mx-auto leading-relaxed">{{ industry.lead }}</p>

                <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                    <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center px-6 py-3.5 text-sm font-bold uppercase tracking-wider text-white bg-[#25D366] rounded-sm hover:bg-[#20bd5a] border-2 border-[#25D366] transition-all duration-150">
                        Book Demo on WhatsApp
                    </a>
                    <a href="#faq"
                       class="inline-flex items-center justify-center px-6 py-3.5 border-2 border-white/30 text-sm font-bold uppercase tracking-wider text-white rounded-sm hover:bg-white/10 transition-all duration-150">
                        Read the FAQs
                    </a>
                </div>
            </div>
        </section>

        <!-- ==================== PROBLEMS AND SOLUTIONS ==================== -->
        <section class="relative bg-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <h2 class="text-xl font-extrabold text-gray-900 mb-2">Sound Familiar?</h2>
                    <div v-for="problem in industry.problems" :key="problem.title" class="bg-white rounded-sm p-5 border-2 border-[#e5e7eb]">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">{{ problem.title }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ problem.desc }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <h2 class="text-xl font-extrabold text-gray-900 mb-2">How WabePoint Helps</h2>
                    <div v-for="solution in industry.solutions" :key="solution.title" class="bg-[#f8fbfd] rounded-sm p-5 border-2 border-[#2596be]/20">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">{{ solution.title }}</h3>
                        <p class="mt-1 text-sm text-gray-700">{{ solution.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== IMAGE AND VIDEO ==================== -->
        <IndustryMedia :industry="industry" />

        <!-- ==================== FAQ ==================== -->
        <section id="faq" class="relative bg-[#f3f4f6] py-16">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Frequently Asked Questions</h2>
                    <p class="mt-2 text-gray-600">Questions {{ industry.label }} owners ask about WabePoint</p>
                </div>

                <div class="space-y-3">
                    <div v-for="(faq, index) in industry.faqs" :key="index" class="overflow-hidden rounded-sm border-2 border-[#e5e7eb] bg-white">
                        <button @click="toggleFaq(index)" class="flex w-full items-center justify-between px-5 py-4 text-left hover:bg-[#f8fbfd] transition">
                            <span class="font-semibold text-gray-900 text-sm">{{ faq.question }}</span>
                            <svg class="h-4 w-4 text-[#2596be] ml-4 flex-shrink-0 transition-transform duration-200" :class="{ 'rotate-180': openFaq === index }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div v-show="openFaq === index" class="border-t border-[#e5e7eb] px-5 py-4 text-sm text-gray-600 leading-relaxed">
                            {{ faq.answer }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== ABOUT ==================== -->
        <IndustryAbout :industry="industry" />

        <!-- ==================== INDUSTRY CAROUSEL ==================== -->
        <IndustryCarousel />

        <!-- ==================== OTHER INDUSTRIES ==================== -->
        <OtherIndustries :current="industry.slug" />

        <!-- ==================== FINAL CTA ==================== -->
        <section class="relative bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] text-white">
            <div class="max-w-4xl mx-auto px-4 py-20 text-center">
                <h2 class="text-2xl md:text-3xl font-extrabold mb-4">Ready to run your {{ industry.label.toLowerCase() }} with WabePoint?</h2>
                <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center px-8 py-4 text-sm font-bold uppercase tracking-wider text-white bg-[#25D366] rounded-sm hover:bg-[#20bd5a] border-2 border-[#25D366] transition-all duration-150">
                    Request Demo on WhatsApp
                </a>
            </div>
        </section>

        <Footer />
    </div>
</template>
