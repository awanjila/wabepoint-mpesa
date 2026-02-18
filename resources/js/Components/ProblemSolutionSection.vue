<template>
    <div id="solutions" class="relative bg-gray-50 py-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-r from-[#33a3dc]/5 to-blue-600/5 rounded-full blur-3xl"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#33a3dc]/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    <span class="block mb-2 text-[#33a3dc] text-base font-semibold tracking-wide">SMART SOLUTIONS</span>
                    From Challenges to Growth
                </h2>
            </div>

            <!-- Problem Solution Grid -->
            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Problems Column -->
                <div class="relative">
                    <div class="sticky top-24 space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 flex items-center mb-8">
                            <span class="w-12 h-12 flex items-center justify-center bg-red-100 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            Business Challenges
                        </h3>
                        <div v-for="(problem, index) in problems" :key="'problem-'+index" 
                             class="group p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                            <h4 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#33a3dc] transition-colors">
                                {{ problem.title }}
                            </h4>
                            <p class="text-gray-600">{{ problem.description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Solutions Column -->
                <div class="relative">
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 flex items-center mb-8">
                            <span class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-[#33a3dc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            Our Solutions
                        </h3>
                        <div v-for="(solution, index) in solutions" :key="'solution-'+index"
                             class="group p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                            <h4 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#33a3dc] transition-colors">
                                {{ solution.title }}
                            </h4>
                            <p class="text-gray-600">{{ solution.description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Impact Section -->
            <div class="mt-24 bg-white rounded-2xl p-8 md:p-12 shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#33a3dc]/10 to-blue-600/10 rounded-full blur-2xl transform translate-x-1/3 -translate-y-1/3"></div>
                <div class="relative">
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center md:text-left">
                            <div class="text-4xl font-bold text-[#33a3dc]">60%</div>
                            <div class="mt-2 text-sm font-medium text-gray-600">Reduction in Manual Work</div>
                        </div>
                        <div class="text-center md:text-left">
                            <div class="text-4xl font-bold text-[#33a3dc]">2x</div>
                            <div class="mt-2 text-sm font-medium text-gray-600">Faster Decision Making</div>
                        </div>
                        <div class="text-center md:text-left">
                            <div class="text-4xl font-bold text-[#33a3dc]">99%</div>
                            <div class="mt-2 text-sm font-medium text-gray-600">Inventory Accuracy</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-16 text-center">
                <a href="https://app.wabepoint.com/register?demo=true" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-lg text-white bg-[#33a3dc] hover:bg-blue-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-blue-500/25">
                    See How It Works
                    <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
const problems = [
    {
        title: 'Manual Process Overload',
        description: 'Time wasted on spreadsheets and paperwork instead of growing your business.'
    },
    {
        title: 'Inventory Chaos',
        description: 'Stock discrepancies and stockouts leading to lost sales and frustrated customers.'
    },
    {
        title: 'Data Blind Spots',
        description: 'Lack of real-time insights making it impossible to make informed decisions.'
    }
];

const solutions = [
    {
        title: 'Smart Automation',
        description: 'Streamlined operations with automated inventory tracking and reordering.'
    },
    {
        title: 'Real-time Control',
        description: 'Complete visibility across all locations with instant stock updates.'
    },
    {
        title: 'Data-Driven Insights',
        description: 'Actionable analytics helping you make better business decisions.'
    }
];
</script>

<style scoped>
.sticky {
    position: sticky;
    top: 2rem;
}
</style>