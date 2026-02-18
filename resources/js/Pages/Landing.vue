<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
import HeroSection from '@/Components/HeroSection.vue';
import ProblemSolutionSection from '@/Components/ProblemSolutionSection.vue';
import FeatureSection from '@/Components/FeatureSection.vue';
import CustomerReviews from '@/Components/CustomerReviews.vue';
import PricingSection from '@/Components/PricingSection.vue';
import FaqSection from '@/Components/FaqSection.vue';
import FinalCta from '@/Components/FinalCta.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <Head>
        <title>Wabepoint - Modern POS & Inventory Management</title>
        <meta name="description" content="Streamline your business operations with Wabepoint's powerful POS and inventory management system." />
        <meta name="keywords" content="POS, inventory management, business software, retail solution" />
        <meta property="og:title" content="Wabepoint - Modern POS & Inventory Management" />
        <meta property="og:description" content="Streamline your business operations with Wabepoint's powerful POS and inventory management system." />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Wabepoint - Modern POS & Inventory Management" />
        <meta name="twitter:description" content="Streamline your business operations with Wabepoint's powerful POS and inventory management system." />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    </Head>

    <div class="min-h-screen bg-gray-100">
        <Navigation :canLogin="canLogin" :canRegister="canRegister" />
        <!-- Hero Section -->
        <HeroSection />
        <ProblemSolutionSection />
        <FeatureSection />
        <CustomerReviews />
        <PricingSection />
        <FaqSection />
        <FinalCta />
        <Footer />
        <!-- Hero Section -->

        
      

        <!-- Main content -->
        <!-- ... existing code ... -->
    </div>
</template>

