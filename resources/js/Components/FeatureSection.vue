<template>
    <div id="features" class="relative bg-gray-50 py-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute bottom-0 left-0 w-[800px] h-[800px] bg-gradient-to-r from-[#33a3dc]/5 to-blue-600/5 rounded-full blur-3xl"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#33a3dc]/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    <span class="block mb-2 text-[#33a3dc] text-base font-semibold tracking-wide">KEY FEATURES</span>
                    Everything You Need to Succeed
                </h2>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="(feature, index) in features" :key="index"
                     class="group bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden">
                    <!-- Background Icon -->
                    <div class="absolute right-0 bottom-0 opacity-5 transform translate-x-1/4 translate-y-1/4">
                        <i :class="['fa-solid', feature.icon, 'text-9xl text-[#33a3dc]']"></i>
                    </div>

                    <!-- Feature Icon -->
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 relative z-10">
                        <i :class="['fa-solid', feature.icon, 'text-[#33a3dc] text-xl']"></i>
                    </div>

                    <!-- Feature Content -->
                    <div class="relative z-10">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 group-hover:text-[#33a3dc] transition-colors">
                            {{ feature.title }}
                        </h3>
                        <p class="text-gray-600 mb-6">{{ feature.description }}</p>

                        <!-- Feature Benefits -->
                        <ul class="space-y-3">
                            <li v-for="(benefit, benefitIndex) in feature.benefits" :key="benefitIndex"
                                class="flex items-start">
                                <i class="fa-solid fa-circle-check text-[#33a3dc] mt-1 mr-3"></i>
                                <span class="text-gray-600">{{ benefit }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Demo CTA Section -->
            <div class="mt-20 bg-gradient-to-r from-[#33a3dc] to-blue-600 rounded-2xl p-8 md:p-12 text-center relative overflow-hidden">
                <!-- Background Decoration -->
                <div class="absolute inset-0">
                    <div class="absolute inset-0 bg-black opacity-10"></div>
                    <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 translate-y-1/2"></div>
                </div>

                <!-- Content -->
                <div class="relative z-10">
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">
                        Ready to Transform Your Business?
                    </h3>
                    <p class="text-white text-opacity-90 mb-8 max-w-2xl mx-auto">
                        See how our features can streamline your operations and boost your growth
                    </p>
                    <a href="https://app.wabepoint.com/register?demo=true" class="inline-flex items-center justify-center px-8 py-4 bg-white text-[#33a3dc] text-base font-medium rounded-lg hover:bg-blue-50 transform hover:scale-105 transition-all duration-200 shadow-lg">
                        Book a Free Demo
                        <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const features = [
    {
        title: 'Smart Inventory Management',
        description: 'Automate your inventory processes and eliminate manual errors.',
        icon: 'fa-boxes-stacked',
        benefits: [
            'Real-time stock tracking',
            'Automated reordering',
            'Multi-location support'
        ]
    },
    {
        title: 'Fast & Intuitive POS',
        description: 'Process transactions quickly with our modern point of sale system.',
        icon: 'fa-cash-register',
        benefits: [
            'One-click checkout',
            'Multiple payment options',
            'Offline capabilities'
        ]
    },
    {
        title: 'Powerful Analytics',
        description: 'Make data-driven decisions with comprehensive insights.',
        icon: 'fa-chart-line',
        benefits: [
            'Custom reports',
            'Sales forecasting',
            'Performance metrics'
        ]
    },
    {
        title: 'Customer Management',
        description: 'Build lasting relationships with your customers.',
        icon: 'fa-users',
        benefits: [
            'Customer profiles',
            'Purchase history',
            'Loyalty programs'
        ]
    },
    {
        title: 'Multi-Branch Control',
        description: 'Manage all your locations from a single dashboard.',
        icon: 'fa-store',
        benefits: [
            'Centralized control',
            'Branch performance',
            'Stock transfer'
        ]
    },
    {
        title: 'Security & User Roles',
        description: 'Keep your business data safe with advanced security.',
        icon: 'fa-shield-halved',
        benefits: [
            'Role-based access',
            'Activity logging',
            'Data encryption'
        ]
    }
];
</script>

<style scoped>
/* Optional: Add any custom styles here */
</style> 