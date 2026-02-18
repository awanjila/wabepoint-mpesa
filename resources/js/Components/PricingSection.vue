<template>
    <div id="pricing" class="relative bg-gray-50 py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Simple, Transparent Pricing
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Choose the perfect plan for your business needs
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Starter Plan -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-gray-100 transform transition-all hover:scale-105">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900">Starter</h3>
                        <p class="mt-4 text-gray-500">Perfect for small retail shops</p>
                        <div class="mt-6">
                            <p class="text-5xl font-extrabold text-gray-900">KES 2,999<span class="text-xl font-normal text-gray-500">/mo</span></p>
                        </div>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">1 POS Terminal</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">Basic Inventory Management</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">WhatsApp Receipts</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">Basic Reports</span>
                            </li>
                        </ul>
                    </div>
                    <div class="px-6 pb-8">
                        <a href="https://app.wabepoint.com/register" class="block w-full bg-[#33a3dc] text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-150">Start Free Trial</a>
                    </div>
                </div>

                <!-- Pro Plan (Most Popular) -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-2 border-[#33a3dc] transform transition-all hover:scale-105 relative">
                    <div class="absolute top-0 right-0 bg-[#33a3dc] text-white px-4 py-1 rounded-bl-lg text-sm font-medium">
                        Most Popular
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900">Pro</h3>
                        <p class="mt-4 text-gray-500">For growing businesses</p>
                        <div class="mt-6">
                            <p class="text-5xl font-extrabold text-gray-900">KES 4,999<span class="text-xl font-normal text-gray-500">/mo</span></p>
                        </div>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">3 POS Terminals</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">Advanced Inventory</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">Customer Management</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-600">Advanced Analytics</span>
                            </li>
                        </ul>
                    </div>
                    <div class="px-6 pb-8">
                        <a href="https://app.wabepoint.com/register" class="block w-full bg-[#33a3dc] text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-150">Start Free Trial</a>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden transform transition-all hover:scale-105">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-white">Enterprise</h3>
                        <p class="mt-4 text-gray-400">Custom solutions for large businesses</p>
                        <div class="mt-6">
                            <p class="text-5xl font-extrabold text-white">Custom<span class="text-xl font-normal text-gray-400"> pricing</span></p>
                        </div>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-300">Unlimited POS Terminals</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-300">Multi-branch Management</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-300">Custom Integration</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-[#33a3dc]" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-3 text-gray-300">24/7 Priority Support</span>
                            </li>
                        </ul>
                    </div>
                    <div class="px-6 pb-8">
                        <a href="https://app.wabepoint.com/register?plan=enterprise" class="block w-full bg-white text-gray-900 text-center px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-150">Schedule Demo</a>
                    </div>
                </div>
            </div>

            <!-- Demo CTA Section -->
            <div class="mt-20 bg-[#33a3dc] rounded-2xl overflow-hidden shadow-xl">
                <div class="px-6 py-12 md:p-12 text-center md:text-left md:flex md:items-center md:justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white">Want to see Wabepoint in action?</h3>
                        <p class="mt-2 text-white text-opacity-90">Get a personalized demo with our product experts</p>
                    </div>
                    <div class="mt-8 md:mt-0">
                        <a href="https://app.wabepoint.com/register?demo=true" class="inline-flex items-center px-6 py-3 border-2 border-white text-base font-medium rounded-lg text-white hover:bg-white hover:text-[#33a3dc] transition duration-150">
                            Request a Live Demo
                            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// No additional setup required for now
</script>

<style scoped>
.hover\:scale-105:hover {
    transition-duration: 300ms;
}
</style> 