<template>
    <div id="faq" class="bg-gray-50 py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Frequently Asked Questions
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Everything you need to know about Wabepoint
                </p>
            </div>

            <div class="max-w-3xl mx-auto divide-y divide-gray-200">
                <div v-for="(faq, index) in faqs" :key="index" class="py-6">
                    <button
                        @click="toggleFaq(index)"
                        class="flex justify-between items-center w-full text-left focus:outline-none"
                    >
                        <span class="text-lg font-medium text-gray-900">{{ faq.question }}</span>
                        <span class="ml-6 flex-shrink-0">
                            <svg
                                class="h-6 w-6 text-[#33a3dc] transform transition-transform duration-200"
                                :class="{ 'rotate-180': openFaq === index }"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </button>
                    <div
                        v-show="openFaq === index"
                        class="mt-4 pr-12"
                    >
                        <p class="text-base text-gray-500">{{ faq.answer }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="mt-16 text-center">
                <p class="text-base text-gray-500">Still have questions?</p>
                <a href="#" class="mt-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#33a3dc] hover:bg-blue-700 transition duration-150">
                    Contact our support team
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const openFaq = ref(null);

const toggleFaq = (index) => {
    openFaq.value = openFaq.value === index ? null : index;
};

const faqs = [
    {
        question: "Does Wabepoint work offline?",
        answer: "Yes! Wabepoint is designed to work seamlessly offline. All your transactions and data are stored locally and will automatically sync once you're back online, ensuring your business never stops."
    },
    {
        question: "Can I use it on my phone?",
        answer: "Absolutely! Wabepoint is fully responsive and works on any device - smartphones, tablets, or computers. You can manage your business on the go with our mobile-optimized interface."
    },
    {
        question: "Is there support if I get stuck?",
        answer: "We provide comprehensive support through multiple channels. This includes 24/7 chat support, detailed documentation, video tutorials, and dedicated account managers for our Pro and Enterprise customers."
    },
    {
        question: "What happens if I lose internet?",
        answer: "Don't worry! Wabepoint continues to function normally offline. You can continue making sales, managing inventory, and running your business. All data will automatically synchronize when your connection is restored."
    },
    {
        question: "Can I use MPESA with Wabepoint?",
        answer: "Yes! Wabepoint fully integrates with MPESA, allowing you to accept payments seamlessly. You can process MPESA transactions, track payments, and reconcile accounts all within the system."
    }
];
</script>

<style scoped>
.rotate-180 {
    transform: rotate(180deg);
}
</style> 