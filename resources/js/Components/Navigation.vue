<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';


defineProps({
    canLogin: {
        type: Boolean,
        default: false
    },
    canRegister: {
        type: Boolean,
        default: false
    }
});

const isOpen = ref(false);

const toggleMenu = () => {
    isOpen.value = !isOpen.value;
};

const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        const offset = 80; // Account for fixed header
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
};
</script>

<template>
    <div class="font-['Inter',sans-serif]">
        <!-- Top row with contact information -->
        <div class="bg-gradient-to-r from-[#33a3dc] to-blue-600 text-white py-2.5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center">
                    <div class="flex items-center space-x-6 text-sm">
                        <a href="tel:+254710909198" class="flex items-center hover:text-white/90 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="font-medium">+254710909198</span>
                        </a>
                        <a href="mailto:support@wabepoint.com" class="flex items-center hover:text-white/90 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium">support@wabepoint.com</span>
                        </a>
                    </div>
                    <div class="hidden sm:flex items-center space-x-4 text-sm">
                        <a href="#" class="hover:text-white/90 transition-colors">Support</a>
                        <span class="text-white/30">|</span>
                        <a href="#" class="hover:text-white/90 transition-colors">Contact</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main navigation -->
        <nav class="bg-white shadow-lg sticky top-0 left-0 right-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <img src="/assets/images/logo/logo.png" alt="Wabepoint Logo" class="h-14 w-auto">
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex lg:items-center lg:space-x-8">
                        <div class="flex space-x-8">
                            <a @click="scrollToSection('features')" class="nav-item-hover inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-[#33a3dc] transition-all duration-200 cursor-pointer">
                                Features
                            </a>
                            <a @click="scrollToSection('pricing')" class="nav-item-hover inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-[#33a3dc] transition-all duration-200 cursor-pointer">
                                Pricing
                            </a>
                            <a @click="scrollToSection('solutions')" class="nav-item-hover inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-[#33a3dc] transition-all duration-200 cursor-pointer">
                                Solutions
                            </a>
                            <a @click="scrollToSection('reviews')" class="nav-item-hover inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-[#33a3dc] transition-all duration-200 cursor-pointer">
                                Reviews
                            </a>
                            <a @click="scrollToSection('faq')" class="nav-item-hover inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-[#33a3dc] transition-all duration-200 cursor-pointer">
                                FAQ
                            </a>

                            <a href="/news" class="nav-item-hover inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-[#33a3dc] transition-all duration-200 cursor-pointer">
                                News & Articles
                            </a>
                        </div>

                        <div class="flex items-center space-x-4">
                            <a href="https://app.wabepoint.com/register" class="inline-flex items-center px-4 py-2 text-sm font-medium text-[#33a3dc] bg-blue-50 rounded-lg hover:bg-blue-100 transition duration-150 cursor-pointer">
                                Start Free Trial
                            </a>
                            <a href="https://app.wabepoint.com/login" class="inline-flex items-center px-4 py-2 border border-[#33a3dc] text-sm font-medium rounded-lg text-[#33a3dc] hover:bg-blue-50 transition duration-150">
                                Login
                            </a>
                            <a href="https://app.wabepoint.com/register?demo=true" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#33a3dc] hover:bg-blue-600 transition duration-150 cursor-pointer">
                                Book Demo
                                <svg class="ml-2 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center lg:hidden">
                        <button @click="toggleMenu" 
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#33a3dc] transition duration-150"
                                :aria-expanded="isOpen">
                            <span class="sr-only">Open main menu</span>
                            <svg :class="{'hidden': isOpen, 'block': !isOpen}" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg :class="{'block': isOpen, 'hidden': !isOpen}" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                <div v-show="isOpen" class="lg:hidden bg-white border-b border-gray-200">
                    <div class="pt-2 pb-3 space-y-1">
                        <a @click="scrollToSection('features'); toggleMenu()" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-[#33a3dc] hover:bg-blue-50 transition duration-150 cursor-pointer">
                            Features
                        </a>
                        <a @click="scrollToSection('pricing'); toggleMenu()" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-[#33a3dc] hover:bg-blue-50 transition duration-150 cursor-pointer">
                            Pricing
                        </a>
                        <a @click="scrollToSection('solutions'); toggleMenu()" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-[#33a3dc] hover:bg-blue-50 transition duration-150 cursor-pointer">
                            Solutions
                        </a>
                        <a @click="scrollToSection('reviews'); toggleMenu()" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-[#33a3dc] hover:bg-blue-50 transition duration-150 cursor-pointer">
                            Reviews
                        </a>
                        <a @click="scrollToSection('faq'); toggleMenu()" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-[#33a3dc] hover:bg-blue-50 transition duration-150 cursor-pointer">
                            FAQ
                        </a>
                    </div>
                    <div class="pt-4 pb-3 border-t border-gray-200">
                        <div class="space-y-1">
                            <a href="https://app.wabepoint.com/register" class="block pl-3 pr-4 py-2 text-base font-medium text-[#33a3dc] hover:bg-blue-50 transition duration-150 cursor-pointer">
                                Start Free Trial
                            </a>
                            <a href="https://app.wabepoint.com/login" class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-[#33a3dc] hover:bg-blue-50 transition duration-150">
                                Login
                            </a>
                            <a href="https://app.wabepoint.com/register?demo=true" class="block pl-3 pr-4 py-2 text-base font-medium text-[#33a3dc] hover:bg-blue-50 transition duration-150 cursor-pointer">
                                Book Demo
                            </a>
                        </div>
                    </div>
                </div>
            </transition>
        </nav>
    </div>
</template>

<style scoped>
/* Custom hover effect for navigation items */
.nav-item-hover {
    position: relative;
}

.nav-item-hover::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: -2px;
    left: 0;
    background-color: #33a3dc;
    transform: scaleX(0);
    transition: transform 0.2s ease-in-out;
}

.nav-item-hover:hover::after {
    transform: scaleX(1);
}

/* Smooth transition for mobile menu */
.mobile-menu-enter-active,
.mobile-menu-leave-active {
    transition: all 0.3s ease-out;
}

.mobile-menu-enter-from,
.mobile-menu-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style> 