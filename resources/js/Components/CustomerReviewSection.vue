<template>
    <div id="reviews" class="relative bg-gray-50 py-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 right-0 w-[800px] h-[800px] bg-gradient-to-l from-[#33a3dc]/5 to-blue-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#33a3dc]/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    <span class="block mb-2 text-[#33a3dc] text-base font-semibold tracking-wide">TRUSTED BY BUSINESSES</span>
                    What Our Customers Say
                </h2>
            </div>

            <!-- Featured Review -->
            <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm mb-16 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#33a3dc]/10 to-blue-600/10 rounded-full blur-2xl transform translate-x-1/3 -translate-y-1/3"></div>
                
                <div class="relative grid md:grid-cols-5 gap-8 items-center">
                    <div class="md:col-span-2">
                        <img src="/assets/images/testimonials/featured-company.jpg" alt="Success Story" class="rounded-xl shadow-lg w-full" />
                    </div>
                    <div class="md:col-span-3">
                        <div class="flex items-center mb-6">
                            <div class="flex text-[#33a3dc]">
                                <svg v-for="i in 5" :key="i" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-600">5.0 rating</span>
                        </div>
                        
                        <blockquote class="text-xl md:text-2xl font-medium text-gray-900 mb-6">
                            "Wabepoint transformed how we manage our inventory. We've reduced stockouts by 90% and saved countless hours on manual processes."
                        </blockquote>
                        
                        <div class="flex items-center">
                            <img src="/assets/images/testimonials/ceo-avatar.jpg" alt="CEO" class="h-12 w-12 rounded-full" />
                            <div class="ml-4">
                                <div class="font-semibold text-gray-900">Sarah Johnson</div>
                                <div class="text-gray-600">CEO, Metro Retail Group</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Grid -->
            <div class="grid md:grid-cols-3 gap-8">
                <div v-for="(review, index) in reviews" :key="index"
                     class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="flex text-[#33a3dc]">
                            <svg v-for="star in review.rating" :key="star" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                    </div>

                    <blockquote class="text-gray-900 mb-6">
                        "{{ review.quote }}"
                    </blockquote>

                    <div class="flex items-center">
                        <img :src="review.avatar" :alt="review.name" class="h-10 w-10 rounded-full" />
                        <div class="ml-3">
                            <div class="font-medium text-gray-900">{{ review.name }}</div>
                            <div class="text-gray-600 text-sm">{{ review.position }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Indicators -->
            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
                <div v-for="(stat, index) in trustStats" :key="index" class="text-center">
                    <div class="text-4xl font-bold text-[#33a3dc] mb-2">{{ stat.value }}</div>
                    <div class="text-gray-600">{{ stat.label }}</div>
                </div>
            </div>

            <!-- Review CTA -->
            <div class="mt-16 text-center">
                <a href="https://app.wabepoint.com/register?source=success_stories" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-lg text-white bg-[#33a3dc] hover:bg-blue-600 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-blue-500/25">
                    View Success Stories
                    <svg class="ml-2 -mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
const reviews = [
    {
        rating: 5,
        quote: "The inventory management system has completely streamlined our operations. It's intuitive and powerful.",
        name: "Michael Chen",
        position: "Operations Manager, TechMart",
        avatar: "/assets/images/testimonials/avatar-1.jpg"
    },
    {
        rating: 5,
        quote: "Customer support is exceptional. They're always there when we need them and quick to resolve issues.",
        name: "Lisa Rodriguez",
        position: "Store Manager, Fashion Hub",
        avatar: "/assets/images/testimonials/avatar-2.jpg"
    },
    {
        rating: 5,
        quote: "The analytics features help us make better decisions. We can now forecast inventory needs accurately.",
        name: "David Kimani",
        position: "Director, Supermart Kenya",
        avatar: "/assets/images/testimonials/avatar-3.jpg"
    }
];

const trustStats = [
    { value: '2000+', label: 'Active Users' },
    { value: '99.9%', label: 'Uptime' },
    { value: '24/7', label: 'Support' },
    { value: '4.9/5', label: 'User Rating' }
];
</script>

<style scoped>
/* Optional: Add any custom styles here */
</style> 