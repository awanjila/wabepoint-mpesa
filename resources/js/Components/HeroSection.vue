<template>
    <div class="relative min-h-screen flex items-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="/assets/images/hero/hero-bg.jpeg" alt="Background" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-gray-900/70"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column: Text Content -->
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white tracking-tight">
                        <span class="block">Transform Your</span>
                        <span class="block text-[#33a3dc] mt-2">Business Today</span>
                    </h1>
                    
                    <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-2xl">
                        Streamline your operations with our all-in-one POS and inventory management solution. Built for modern businesses.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="https://app.wabepoint.com/register?demo=true" 
                           class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-lg text-white bg-[#33a3dc] hover:bg-blue-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-blue-500/25">
                            Book a Demo
                            <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="https://app.wabepoint.com/register" 
                           class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-base font-medium rounded-lg text-white hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-200">
                            Start Free Trialff
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="mt-12 grid grid-cols-2 gap-8 lg:grid-cols-4">
                        <div class="flex flex-col items-center lg:items-start">
                            <div class="text-3xl font-bold text-white">2000+</div>
                            <div class="mt-1 text-sm text-gray-400">Active Users</div>
                        </div>
                        <div class="flex flex-col items-center lg:items-start">
                            <div class="text-3xl font-bold text-white">99.9%</div>
                            <div class="mt-1 text-sm text-gray-400">Uptime</div>
                        </div>
                        <div class="flex flex-col items-center lg:items-start">
                            <div class="text-3xl font-bold text-white">24/7</div>
                            <div class="mt-1 text-sm text-gray-400">Support</div>
                        </div>
                        <div class="flex flex-col items-center lg:items-start">
                            <div class="text-3xl font-bold text-white">4.9/5</div>
                            <div class="mt-1 text-sm text-gray-400">User Rating</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Feature Preview -->
                <div class="hidden lg:block relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-tr from-[#33a3dc]/20 to-blue-600/20 backdrop-blur-sm"></div>
                        <img src="assets/images/hero/dashboard-preview.png" alt="Wabepoint Dashboard" class="w-full h-auto relative z-10" />
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-[#33a3dc] rounded-full opacity-20 blur-2xl"></div>
                    <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-blue-600 rounded-full opacity-20 blur-2xl"></div>
                    
                    <!-- Feature Cards -->
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-lg p-4 shadow-lg transform hover:scale-105 transition-all duration-200">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-[#33a3dc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Real-time Updates</div>
                                <div class="text-xs text-gray-600">Instant sync across devices</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-auto" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 30L60 25C120 20 240 10 360 15C480 20 600 40 720 45C840 50 960 40 1080 35C1200 30 1320 30 1380 30L1440 30V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V30Z" fill="white"/>
            </svg>
        </div>
    </div>
</template>

<script setup>
// No additional setup required
</script>

<style scoped>
/* Optional: Add any custom styles here */
</style> 