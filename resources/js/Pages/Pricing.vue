<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'

defineProps({ seo: Object })

const whatsappNumber = '254781312070'
const whatsappMessage = encodeURIComponent("Hi, I'm interested in WabePoint POS. I'd like to book a demo.")
const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${whatsappMessage}`

const plans = [
  {
    name: 'Core',
    price: '2,000',
    desc: 'Basic POS with sales, receipt printing, stock tracking, reports, and offline support.',
    features: [
      'Sales & POS', 'Receipt printing', 'Stock tracking',
      'Basic reports', 'Offline support', 'Multiple payment methods',
    ],
    highlighted: false,
  },
  {
    name: 'Flow',
    price: '3,500',
    desc: 'Everything in Core + M-Pesa STK Push, faster checkout, and payment tracking.',
    features: [
      'Everything in Core', 'M-Pesa STK Push', 'Faster checkout',
      'Payment tracking', 'Customer management', 'Priority support',
    ],
    highlighted: true,
    badge: 'Most Popular',
  },
  {
    name: 'Comply',
    price: '6,000',
    desc: 'Everything in Flow + KRA eTIMS integration, tax records, and compliance reports.',
    features: [
      'Everything in Flow', 'KRA eTIMS integration', 'Tax records',
      'Compliance reports', 'Advanced analytics', 'API access', 'Dedicated support',
    ],
    highlighted: false,
  },
]

const compareFeatures = [
  { name: 'Sales & POS', core: true, flow: true, comply: true },
  { name: 'Receipt printing', core: true, flow: true, comply: true },
  { name: 'Stock tracking', core: true, flow: true, comply: true },
  { name: 'Basic reports', core: true, flow: true, comply: true },
  { name: 'Offline support', core: true, flow: true, comply: true },
  { name: 'Multiple payment methods', core: true, flow: true, comply: true },
  { name: 'M-Pesa STK Push', core: false, flow: true, comply: true },
  { name: 'Payment tracking & reconciliation', core: false, flow: true, comply: true },
  { name: 'Customer management', core: false, flow: true, comply: true },
  { name: 'Priority support', core: false, flow: true, comply: true },
  { name: 'KRA eTIMS integration', core: false, flow: false, comply: true },
  { name: 'Tax records & compliance reports', core: false, flow: false, comply: true },
  { name: 'Advanced analytics', core: false, flow: false, comply: true },
  { name: 'API access', core: false, flow: false, comply: true },
  { name: 'Dedicated support', core: false, flow: false, comply: true },
]

const faqs = [
  {
    q: 'What is the difference between Core, Flow, and Comply?',
    a: 'Core is basic POS with sales, stock tracking, and offline support. Flow adds M-Pesa STK Push for customer payment prompts. Comply includes KRA eTIMS integration for tax compliance and advanced analytics.',
  },
  {
    q: 'Does it work without internet?',
    a: 'Yes. Sales are recorded locally and sync automatically when internet returns. Works for all industries — paint shops, hardware stores, restaurants, cosmetics, and offices.',
  },
  {
    q: 'How long does setup take?',
    a: 'Products loaded, cashiers configured, and your team trained in under 1 hour. We handle everything remotely.',
  },
  {
    q: 'Can I change plans later?',
    a: 'Yes. You can upgrade or downgrade anytime. If you start with Core and later need M-Pesa integration or KRA eTIMS, we switch you to Flow or Comply immediately — no setup fee.',
  },
  {
    q: 'What devices does it work on?',
    a: 'Any tablet, phone, or computer with a browser. Install as a PWA for a native app experience.',
  },
  {
    q: 'Is there a free trial?',
    a: 'Yes. Contact us on WhatsApp for a free demo and trial period. No commitment required.',
  },
]

const openFaq = ref(null)
function toggleFaq(index) {
  openFaq.value = openFaq.value === index ? null : index
}
</script>

<template>
  <Head>
    <title>{{ seo?.title || 'Pricing - WabePoint POS & Inventory System' }}</title>
    <meta name="description" :content="seo?.description" />
  </Head>

  <div class="min-h-screen bg-[#f3f4f6] font-sans antialiased">
    <Navigation :canLogin="true" :canRegister="true" />

    <!-- Hero -->
    <section class="relative bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] text-white overflow-hidden">
      <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 40px 40px;"></div>
      <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#2596be]/10 rounded-full blur-3xl"></div>
      <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#25D366]/5 rounded-full blur-3xl"></div>
      <div class="relative z-10 max-w-4xl mx-auto px-4 py-20 sm:py-24 text-center">
        <span class="inline-block px-3 py-1 bg-[#2596be]/20 text-[#5ec4e8] text-xs font-bold uppercase tracking-widest rounded-sm mb-4 border border-[#2596be]/30">Flat Monthly Pricing, No Hidden Fees</span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4">Choose the Plan That<br><span class="text-[#5ec4e8]">Fits Your Business</span></h1>
        <p class="text-white/70 text-base sm:text-lg max-w-2xl mx-auto">Start with what you need. Upgrade anytime. One system for POS, inventory, payments, and compliance.</p>
      </div>
    </section>

    <!-- Pricing Cards -->
    <section class="max-w-6xl mx-auto px-4 -mt-12 relative z-20 pb-16">
      <div class="grid md:grid-cols-3 gap-6">
        <div v-for="plan in plans" :key="plan.name"
             class="relative bg-white rounded-sm border-2 transition-all duration-150 flex flex-col"
             :class="plan.highlighted ? 'border-[#2596be] shadow-md scale-[1.02]' : 'border-[#e5e7eb] hover:border-[#2596be]/50'">
          <div v-if="plan.badge" class="absolute top-0 right-0 bg-[#2596be] text-white px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-bl-sm">{{ plan.badge }}</div>
          <div class="p-6 flex flex-col flex-1">
            <h3 class="text-lg font-extrabold uppercase tracking-wide"
                :class="plan.highlighted ? 'text-[#2596be]' : 'text-gray-900'">WabePoint {{ plan.name }}</h3>
            <div class="mt-4">
              <span class="text-4xl font-extrabold text-gray-900">KES {{ plan.price }}</span>
              <span class="text-sm text-gray-500">/month</span>
            </div>
            <p class="mt-1 text-xs text-gray-500">{{ plan.desc }}</p>
            <ul class="mt-6 space-y-3 flex-1">
              <li v-for="item in plan.features" :key="item" class="flex items-start text-sm text-gray-700">
                <svg class="h-4 w-4 text-[#2596be] mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ item }}
              </li>
            </ul>
            <div class="mt-6 pt-6 border-t border-gray-100">
              <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer"
                 class="block w-full text-center py-2.5 text-xs font-bold uppercase tracking-wider transition-all duration-150 rounded-sm border-2"
                 :class="plan.highlighted
                   ? 'text-white bg-[#2596be] border-[#2596be] hover:bg-[#1e7a9e]'
                   : 'text-[#2596be] border-[#2596be] hover:bg-[#2596be] hover:text-white'">
                Get {{ plan.name }}
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Installation Fee Notice -->
      <div class="mt-8 max-w-2xl mx-auto text-center bg-white border-2 border-[#e5e7eb] rounded-sm p-6">
        <p class="text-sm text-gray-600">
          <span class="font-bold text-gray-900">All plans require a one-time installation fee.</span>
          We handle hardware setup, M-Pesa &amp; KRA eTIMS API configuration, product upload, and staff training.
        </p>
        <div class="mt-4 flex flex-wrap items-center justify-center gap-x-8 gap-y-2 text-sm">
          <span class="font-bold text-gray-900">KES 20,000</span>
          <span class="text-gray-400">/</span>
          <span class="text-gray-600">per branch &middot; one-time</span>
          <span class="text-gray-300 hidden sm:inline">|</span>
          <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer" class="text-[#2596be] hover:underline font-semibold">Learn what's included &rarr;</a>
        </div>
      </div>
    </section>

    <!-- Setup Tiers -->
    <section class="py-16 bg-white">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <span class="inline-block px-3 py-1 bg-[#2596be]/10 text-[#2596be] text-xs font-bold uppercase tracking-widest rounded-sm mb-3 border border-[#2596be]/20">SETUP FEE</span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Installation Fee by Business Size</h2>
          <p class="mt-2 text-gray-600">One-time charge per branch. Includes remote setup, integration, and training.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
          <div class="bg-white rounded-sm border-2 border-[#e5e7eb] hover:border-[#2596be]/50 transition-all p-6 text-center">
            <h4 class="text-sm font-bold text-[#2596be] uppercase tracking-wider mb-1">Small Shop</h4>
            <p class="text-xs text-gray-400 mb-3">Cosmetics, Salon, Retail</p>
            <span class="text-2xl font-extrabold text-gray-900">KES 20,000</span>
            <ul class="mt-4 space-y-2 text-xs text-gray-600 text-left">
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Hardware configuration</li>
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Product catalogue upload</li>
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Staff training session</li>
            </ul>
          </div>
          <div class="bg-white rounded-sm border-2 border-[#2596be] shadow-md p-6 text-center relative scale-[1.02]">
            <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 px-2 bg-white text-[10px] font-bold uppercase tracking-wider text-[#2596be] border border-[#2596be]/30 rounded-sm">Most Common</span>
            <h4 class="text-sm font-bold text-[#2596be] uppercase tracking-wider mb-1">Medium Business</h4>
            <p class="text-xs text-gray-400 mb-3">Hardware, Paint Shop, Restaurant</p>
            <span class="text-2xl font-extrabold text-gray-900">KES 20,000</span>
            <ul class="mt-4 space-y-2 text-xs text-gray-600 text-left">
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Everything in Small Shop</li>
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>M-Pesa Paybill API setup</li>
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>KRA eTIMS registration</li>
            </ul>
          </div>
          <div class="bg-white rounded-sm border-2 border-[#e5e7eb] hover:border-[#2596be]/50 transition-all p-6 text-center">
            <h4 class="text-sm font-bold text-[#2596be] uppercase tracking-wider mb-1">Multi-Branch</h4>
            <p class="text-xs text-gray-400 mb-3">Supermarket, Wholesale, Chain</p>
            <span class="text-2xl font-extrabold text-gray-900">Custom Quote</span>
            <ul class="mt-4 space-y-2 text-xs text-gray-600 text-left">
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Bulk hardware deployment</li>
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Multi-branch configuration</li>
              <li class="flex items-start gap-2"><svg class="w-3.5 h-3.5 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>Dedicated onboarding manager</li>
            </ul>
          </div>
        </div>
        <div class="text-center mt-6">
          <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-6 py-3 bg-[#2596be] text-white text-sm font-bold uppercase tracking-wider rounded-sm hover:bg-[#1e7a9e] transition-colors text-center">Get a Custom Quote</a>
        </div>
      </div>
    </section>

    <!-- Feature Comparison -->
    <section class="py-16 bg-white">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <span class="inline-block px-3 py-1 bg-[#2596be]/10 text-[#2596be] text-xs font-bold uppercase tracking-widest rounded-sm mb-3 border border-[#2596be]/20">COMPARE PLANS</span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">What's Included in Each Plan</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b-2 border-gray-200">
                <th class="text-left py-4 pr-4 font-bold text-gray-900 uppercase tracking-wider">Feature</th>
                <th class="text-center py-4 px-4 font-bold text-gray-900 uppercase tracking-wider">Core</th>
                <th class="text-center py-4 px-4 font-bold text-[#2596be] uppercase tracking-wider bg-[#2596be]/5">Flow</th>
                <th class="text-center py-4 pl-4 font-bold text-gray-900 uppercase tracking-wider">Comply</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(feat, i) in compareFeatures" :key="feat.name"
                  class="border-b border-gray-100"
                  :class="i % 2 === 0 ? 'bg-gray-50/50' : ''">
                <td class="py-3 pr-4 text-gray-700 font-medium">{{ feat.name }}</td>
                <td class="text-center py-3 px-4">
                  <svg v-if="feat.core" class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span v-else class="text-gray-300">&mdash;</span>
                </td>
                <td class="text-center py-3 px-4 bg-[#2596be]/5">
                  <svg v-if="feat.flow" class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span v-else class="text-gray-300">&mdash;</span>
                </td>
                <td class="text-center py-3 pl-4">
                  <svg v-if="feat.comply" class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                  <span v-else class="text-gray-300">&mdash;</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Industries -->
    <section class="py-16 bg-[#f3f4f6]">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <span class="inline-block px-3 py-1 bg-[#2596be]/10 text-[#2596be] text-xs font-bold uppercase tracking-widest rounded-sm mb-3 border border-[#2596be]/20">INDUSTRIES</span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Built for Your Industry</h2>
          <p class="mt-2 text-gray-600">Same price. Tailored features for each business type.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
          <div class="bg-white rounded-sm p-5 border-2 border-[#e5e7eb] hover:border-[#2596be] transition-all duration-150 text-center">
            <div class="w-10 h-10 mx-auto mb-3 bg-[#2596be]/10 rounded-sm flex items-center justify-center border border-[#2596be]/20">
              <svg class="w-5 h-5 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Cosmetics</h3>
            <p class="mt-1 text-xs text-gray-600">Shade & expiry tracking</p>
          </div>
          <div class="bg-white rounded-sm p-5 border-2 border-[#e5e7eb] hover:border-[#2596be] transition-all duration-150 text-center">
            <div class="w-10 h-10 mx-auto mb-3 bg-[#2596be]/10 rounded-sm flex items-center justify-center border border-[#2596be]/20">
              <svg class="w-5 h-5 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Hardware</h3>
            <p class="mt-1 text-xs text-gray-600">Bulk stock & variant pricing</p>
          </div>
          <div class="bg-white rounded-sm p-5 border-2 border-[#e5e7eb] hover:border-[#2596be] transition-all duration-150 text-center">
            <div class="w-10 h-10 mx-auto mb-3 bg-[#2596be]/10 rounded-sm flex items-center justify-center border border-[#2596be]/20">
              <svg class="w-5 h-5 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Paint Shops</h3>
            <p class="mt-1 text-xs text-gray-600">Fraction & litre tracking</p>
          </div>
          <div class="bg-white rounded-sm p-5 border-2 border-[#e5e7eb] hover:border-[#2596be] transition-all duration-150 text-center">
            <div class="w-10 h-10 mx-auto mb-3 bg-[#2596be]/10 rounded-sm flex items-center justify-center border border-[#2596be]/20">
              <svg class="w-5 h-5 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Restaurants</h3>
            <p class="mt-1 text-xs text-gray-600">Table & kitchen management</p>
          </div>
          <div class="bg-white rounded-sm p-5 border-2 border-[#e5e7eb] hover:border-[#2596be] transition-all duration-150 text-center">
            <div class="w-10 h-10 mx-auto mb-3 bg-[#2596be]/10 rounded-sm flex items-center justify-center border border-[#2596be]/20">
              <svg class="w-5 h-5 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Offices</h3>
            <p class="mt-1 text-xs text-gray-600">Invoicing & PO tracking</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Setup Process -->
    <section class="py-16 bg-white">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <span class="inline-block px-3 py-1 bg-[#2596be]/10 text-[#2596be] text-xs font-bold uppercase tracking-widest rounded-sm mb-3 border border-[#2596be]/20">SIMPLE SETUP</span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Up and Running in Under 1 Hour</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="text-center group">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-sm bg-gradient-to-br from-[#2596be] to-[#1e7a9e] text-2xl font-extrabold text-white shadow-md group-hover:shadow-lg transition-all">1</div>
            <h3 class="mb-2 text-base font-bold text-gray-900 uppercase tracking-wide">System Installed</h3>
            <p class="text-sm text-gray-600 leading-relaxed">We load your products, configure payments, and train your team. Done in under 1 hour.</p>
          </div>
          <div class="text-center group">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-sm bg-gradient-to-br from-[#2596be] to-[#1e7a9e] text-2xl font-extrabold text-white shadow-md group-hover:shadow-lg transition-all">2</div>
            <h3 class="mb-2 text-base font-bold text-gray-900 uppercase tracking-wide">Start Selling</h3>
            <p class="text-sm text-gray-600 leading-relaxed">Tap, add to cart, select payment. Any staff can use it within 5 minutes.</p>
          </div>
          <div class="text-center group">
            <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-sm bg-gradient-to-br from-[#2596be] to-[#1e7a9e] text-2xl font-extrabold text-white shadow-md group-hover:shadow-lg transition-all">3</div>
            <h3 class="mb-2 text-base font-bold text-gray-900 uppercase tracking-wide">View Reports</h3>
            <p class="text-sm text-gray-600 leading-relaxed">Check stock, daily sales, and profit from anywhere on your phone or computer.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="py-16 bg-[#f3f4f6]">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <span class="inline-block px-3 py-1 bg-[#2596be]/10 text-[#2596be] text-xs font-bold uppercase tracking-widest rounded-sm mb-3 border border-[#2596be]/20">FAQ</span>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Frequently Asked Questions</h2>
        </div>
        <div class="space-y-3">
          <div v-for="(faq, index) in faqs" :key="index" class="overflow-hidden rounded-sm border-2 border-[#e5e7eb] bg-white hover:border-[#2596be]/30 transition-all">
            <button @click="toggleFaq(index)" class="flex w-full items-center justify-between px-5 py-4 text-left hover:bg-[#f8fbfd] transition">
              <span class="font-semibold text-gray-900 text-sm">{{ faq.q }}</span>
              <svg class="h-4 w-4 text-[#2596be] ml-4 flex-shrink-0 transition-transform duration-200" :class="{ 'rotate-180': openFaq === index }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div v-show="openFaq === index" class="border-t border-[#e5e7eb] px-5 py-4 text-sm text-gray-600 leading-relaxed">{{ faq.a }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Final CTA -->
    <section class="relative bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] text-white overflow-hidden">
      <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 40px 40px;"></div>
      <div class="absolute top-0 right-0 w-80 h-80 bg-[#2596be]/10 rounded-full blur-3xl"></div>
      <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold mb-4 leading-tight">
          READY TO TAKE CONTROL<br>
          <span class="text-[#5ec4e8]">OF YOUR BUSINESS?</span>
        </h2>
        <p class="text-base text-white/60 mb-8 max-w-xl mx-auto">
          Join businesses across Kenya using WabePoint to track sales, manage stock, and grow with confidence.
        </p>
        <a :href="whatsappUrl" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center justify-center px-8 py-4 text-sm font-bold uppercase tracking-wider text-white bg-[#25D366] rounded-sm hover:bg-[#20bd5a] shadow-lg shadow-[#25D366]/20 transition-all duration-150 border-2 border-[#25D366] hover:shadow-xl hover:shadow-[#25D366]/30">
          <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.952 11.952 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.386 0-4.592-.828-6.328-2.208l-.44-.352-3.24 1.085 1.085-3.24-.352-.44A9.958 9.958 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/>
          </svg>
          Request Demo on WhatsApp
        </a>
      </div>
    </section>

    <Footer />
  </div>
</template>