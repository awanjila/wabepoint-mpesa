<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'

defineProps({
    canLogin: { type: Boolean, default: false },
    canRegister: { type: Boolean, default: false },
})

const isOpen = ref(false)
const posDropdownOpen = ref(false)
const posDropdownRef = ref(null)
const servicesDropdownOpen = ref(false)
const servicesDropdownRef = ref(null)
const resourcesDropdownOpen = ref(false)
const resourcesDropdownRef = ref(null)

const toggleMenu = () => { isOpen.value = !isOpen.value }

const closeDropdowns = (e) => {
    if (posDropdownRef.value && !posDropdownRef.value.contains(e.target)) posDropdownOpen.value = false
    if (servicesDropdownRef.value && !servicesDropdownRef.value.contains(e.target)) servicesDropdownOpen.value = false
    if (resourcesDropdownRef.value && !resourcesDropdownRef.value.contains(e.target)) resourcesDropdownOpen.value = false
}

onMounted(() => document.addEventListener('click', closeDropdowns))
onUnmounted(() => document.removeEventListener('click', closeDropdowns))

const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId)
    if (element) {
        const offset = 80
        const elementPosition = element.getBoundingClientRect().top
        window.scrollTo({ top: elementPosition + window.pageYOffset - offset, behavior: 'smooth' })
    }
}
</script>

<template>
    <div class="font-['Inter',sans-serif]">
        <!-- Top bar -->
        <div class="bg-gradient-to-r from-[#2596be] to-[#2596be] text-white py-2.5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center text-sm">
                    <div class="flex items-center space-x-6">
                        <a href="tel:+254710909198" class="flex items-center hover:text-white/90 transition-colors">
                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="font-medium">+254 781 312 070</span>
                        </a>
                        <a href="mailto:support@wabepoint.com" class="flex items-center hover:text-white/90 transition-colors">
                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium">support@wabepoint.com</span>
                        </a>
                    </div>
                    <span class="hidden sm:block text-white/80 font-medium tracking-wide">ALL-IN-ONE POS SYSTEM</span>
                </div>
            </div>
        </div>

        <!-- Main nav -->
        <nav class="bg-white shadow-sm sticky top-0 left-0 right-0 z-50 border-b-2 border-[#2596be]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <Link href="/">
                            <img src="/assets/images/logo/logo.png" alt="WabePoint" class="h-9 w-auto" />
                        </Link>
                        <span class="ml-3 px-2 py-0.5 bg-[#2596be]/10 text-[#2596be] text-xs font-bold uppercase tracking-wider rounded-sm border border-[#2596be]/20">POS</span>
                    </div>

                    <!-- Desktop nav links -->
                    <div class="hidden md:flex items-center space-x-6">
                        <!-- Point Of Sale Dropdown -->
                        <div ref="posDropdownRef" class="relative"
                             @mouseenter="posDropdownOpen = true"
                             @mouseleave="posDropdownOpen = false">
                            <button class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-700 hover:text-[#2596be] transition-colors">
                                Point Of Sale
                                <svg :class="{'rotate-180': posDropdownOpen}" class="ml-1 h-3.5 w-3.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <transition
                                enter-active-class="transition duration-150 ease-out"
                                enter-from-class="opacity-0 scale-95"
                                enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="opacity-100 scale-100"
                                leave-to-class="opacity-0 scale-95"
                            >
                                <div v-show="posDropdownOpen" class="absolute left-0 mt-2 w-72 rounded-sm shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="grid grid-cols-2 gap-1 p-2">
                                        <a href="/cosmetics" class="flex flex-col items-center gap-1 px-3 py-3 text-center rounded-sm hover:bg-gray-50 hover:text-[#2596be] transition-colors group">
                                            <svg class="w-7 h-7 text-gray-500 group-hover:text-[#2596be] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-700 group-hover:text-[#2596be]">Cosmetics</span>
                                        </a>
                                        <a href="/hardware" class="flex flex-col items-center gap-1 px-3 py-3 text-center rounded-sm hover:bg-gray-50 hover:text-[#2596be] transition-colors group">
                                            <svg class="w-7 h-7 text-gray-500 group-hover:text-[#2596be] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-700 group-hover:text-[#2596be]">Hardware</span>
                                        </a>
                                        <a href="/paintshops" class="flex flex-col items-center gap-1 px-3 py-3 text-center rounded-sm hover:bg-gray-50 hover:text-[#2596be] transition-colors group">
                                            <svg class="w-7 h-7 text-gray-500 group-hover:text-[#2596be] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-700 group-hover:text-[#2596be]">Paint Shops</span>
                                        </a>
                                        <a href="/restaurants" class="flex flex-col items-center gap-1 px-3 py-3 text-center rounded-sm hover:bg-gray-50 hover:text-[#2596be] transition-colors group">
                                            <svg class="w-7 h-7 text-gray-500 group-hover:text-[#2596be] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-700 group-hover:text-[#2596be]">Restaurants</span>
                                        </a>
                                        <a href="/offices" class="flex flex-col items-center gap-1 px-3 py-3 text-center rounded-sm hover:bg-gray-50 hover:text-[#2596be] transition-colors group col-span-2 max-w-[140px] mx-auto">
                                            <svg class="w-7 h-7 text-gray-500 group-hover:text-[#2596be] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-700 group-hover:text-[#2596be]">Offices</span>
                                        </a>
                                    </div>
                                </div>
                            </transition>
                        </div>

                        <!-- Our Services Dropdown -->
                        <div ref="servicesDropdownRef" class="relative"
                             @mouseenter="servicesDropdownOpen = true"
                             @mouseleave="servicesDropdownOpen = false">
                            <button class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-700 hover:text-[#2596be] transition-colors">
                                Our Services
                                <svg :class="{'rotate-180': servicesDropdownOpen}" class="ml-1 h-3.5 w-3.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <transition
                                enter-active-class="transition duration-150 ease-out"
                                enter-from-class="opacity-0 scale-95"
                                enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="opacity-100 scale-100"
                                leave-to-class="opacity-0 scale-95"
                            >
                                <div v-show="servicesDropdownOpen" class="absolute left-0 mt-2 w-64 rounded-sm shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <a href="/point-of-sale-system-kenya#kra-etims" @click="servicesDropdownOpen = false" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">KRA eTIMS Integration</div>
                                                <div class="text-xs text-gray-400">Tax compliance made simple</div>
                                            </div>
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <a href="/point-of-sale-system-kenya#mpesa-paybill" @click="servicesDropdownOpen = false" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">M-Pesa Paybill Integration</div>
                                                <div class="text-xs text-gray-400">Seamless mobile payments</div>
                                            </div>
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <a href="/point-of-sale-system-kenya#quotation-invoicing" @click="servicesDropdownOpen = false" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">Quotation & Invoicing</div>
                                                <div class="text-xs text-gray-400">Professional quotes & invoices</div>
                                            </div>
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <a href="/point-of-sale-system-kenya#expense-tracking" @click="servicesDropdownOpen = false" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">Expense Tracking</div>
                                                <div class="text-xs text-gray-400">Monitor every shilling</div>
                                            </div>
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <a href="/point-of-sale-system-kenya#debtors-creditors" @click="servicesDropdownOpen = false" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">Debtors & Creditors</div>
                                                <div class="text-xs text-gray-400">Track who owes what</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </transition>
                        </div>

                        <!-- Pricing Link -->
                        <Link href="/pricing" class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-700 hover:text-[#2596be] transition-colors">
                            Pricing
                        </Link>

                        <!-- Resources Dropdown -->
                        <div ref="resourcesDropdownRef" class="relative"
                             @mouseenter="resourcesDropdownOpen = true"
                             @mouseleave="resourcesDropdownOpen = false">
                            <button class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-700 hover:text-[#2596be] transition-colors">
                                Resources
                                <svg :class="{'rotate-180': resourcesDropdownOpen}" class="ml-1 h-3.5 w-3.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <transition
                                enter-active-class="transition duration-150 ease-out"
                                enter-from-class="opacity-0 scale-95"
                                enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="opacity-100 scale-100"
                                leave-to-class="opacity-0 scale-95"
                            >
                                <div v-show="resourcesDropdownOpen" class="absolute left-0 mt-2 w-52 rounded-sm shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <a href="/success-stories" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">Success Stories</div>
                                                <div class="text-xs text-gray-400">See how businesses grow with us</div>
                                            </div>
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <a href="/news" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">Blog / Guide</div>
                                                <div class="text-xs text-gray-400">Tips, tutorials & industry insights</div>
                                            </div>
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <a href="/support" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2596be] transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                            <div>
                                                <div class="font-semibold">Support Contacts</div>
                                                <div class="text-xs text-gray-400">Get help when you need it</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <a href="https://app.wabepoint.com" target="_blank" rel="noopener noreferrer"
                           class="hidden sm:inline-flex items-center text-xs font-bold uppercase tracking-wider text-gray-600 hover:text-[#2596be] transition-colors">
                            Login
                        </a>
                        <a href="https://app.wabepoint.com/register" target="_blank" rel="noopener noreferrer"
                           class="hidden sm:inline-flex items-center px-4 py-2 text-xs font-bold uppercase tracking-wider text-white bg-[#2596be] rounded-sm hover:bg-[#1a6d8a] transition-all duration-150">
                            Get Started
                        </a>
                        <!-- Mobile hamburger -->
                        <button @click="toggleMenu"
                                class="md:hidden inline-flex items-center justify-center p-2 rounded-sm text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path v-if="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="transform -translate-y-2 opacity-0"
                enter-to-class="transform translate-y-0 opacity-100"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="transform translate-y-0 opacity-100"
                leave-to-class="transform -translate-y-2 opacity-0"
            >
                <div v-show="isOpen" class="md:hidden bg-white border-t border-gray-200">
                    <div class="pt-2 pb-3 space-y-1">
                        <div class="pl-4 pr-4 py-2 text-xs font-bold uppercase tracking-wider text-gray-400">Point Of Sale</div>
                        <a href="/cosmetics" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Cosmetics</a>
                        <a href="/hardware" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Hardware</a>
                        <a href="/paintshops" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Paint Shops</a>
                        <a href="/restaurants" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Restaurants</a>
                        <a href="/offices" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Offices</a>
                        <div class="border-t border-gray-100 mt-2 pt-2"></div>
                        <div class="pl-4 pr-4 py-2 text-xs font-bold uppercase tracking-wider text-gray-400">Our Services</div>
                        <a href="/point-of-sale-system-kenya#kra-etims" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">KRA eTIMS Integration</a>
                        <a href="/point-of-sale-system-kenya#mpesa-paybill" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">M-Pesa Paybill Integration</a>
                        <a href="/point-of-sale-system-kenya#quotation-invoicing" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Quotation & Invoicing</a>
                        <a href="/point-of-sale-system-kenya#expense-tracking" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Expense Tracking</a>
                        <a href="/point-of-sale-system-kenya#debtors-creditors" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Debtors & Creditors</a>
                        <div class="border-t border-gray-100 mt-2 pt-2"></div>
                        <a href="/pricing" @click="isOpen = false" class="block pl-4 pr-4 py-2 text-sm font-bold uppercase tracking-wider text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Pricing</a>
                        <div class="border-t border-gray-100 mt-2 pt-2"></div>
                        <div class="pl-4 pr-4 py-2 text-xs font-bold uppercase tracking-wider text-gray-400">Resources</div>
                        <a href="/success-stories" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Success Stories</a>
                        <a href="/news" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Blog / Guide</a>
                        <a href="/support" @click="isOpen = false" class="block pl-6 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">Support Contacts</a>
                    </div>
                    <div class="border-t border-gray-200 pt-2 pb-3 space-y-1">
                        <a href="https://app.wabepoint.com" target="_blank" rel="noopener noreferrer"
                           class="block pl-4 pr-4 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] hover:bg-gray-50 transition-colors">
                            Login
                        </a>
                        <a href="https://app.wabepoint.com/register" target="_blank" rel="noopener noreferrer"
                           class="mx-3 block px-4 py-2 text-sm font-bold uppercase tracking-wider text-center text-white bg-[#2596be] rounded-sm hover:bg-[#1a6d8a] transition-colors">
                            Get Started
                        </a>
                    </div>
                </div>
            </transition>
        </nav>

        <!-- Floating WhatsApp Widget -->
        <a :href="`https://wa.me/254781312070?text=${encodeURIComponent('Hi, I\'m interested in WabePoint POS. I\'d like to book a demo.')}`"
           target="_blank" rel="noopener noreferrer"
           class="fixed bottom-6 right-6 z-50 flex items-center gap-2 bg-[#25D366] text-white px-4 py-3 rounded-full shadow-lg hover:bg-[#20bd5a] transition-all duration-200 hover:shadow-xl hover:-translate-y-0.5 group">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.952 11.952 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.386 0-4.592-.828-6.328-2.208l-.44-.352-3.24 1.085 1.085-3.24-.352-.44A9.958 9.958 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/>
            </svg>
            <span class="text-sm font-semibold hidden sm:inline">Chat on WhatsApp</span>
            <span class="text-sm font-semibold sm:hidden">WhatsApp</span>
        </a>
    </div>
</template>
