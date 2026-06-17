<script setup>
import { Head, Link } from '@inertiajs/vue3'
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'

defineProps({ seo: Object })

const services = [
    {
        id: 'kra-etims',
        title: 'KRA eTIMS Integration',
        subtitle: 'Tax compliance made simple',
        icon: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        points: [
            'Automatic KRA eTIMS invoice generation with every sale',
            'Real-time tax reporting to Kenya Revenue Authority',
            'No more manual entries — reduce errors and save time',
            'eTIMS compliant receipts printed automatically',
            'Audit-ready records at your fingertips',
        ],
        desc: 'Stay compliant with KRA eTIMS regulations effortlessly. WabePoint automatically generates and transmits tax invoices to KRA in real-time, so you never miss a deadline or face penalties.',
    },
    {
        id: 'mpesa-paybill',
        title: 'M-Pesa Paybill Integration',
        subtitle: 'Seamless mobile payments',
        icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        points: [
            'M-Pesa STK Push — customers pay directly from their phone',
            'Automatic reconciliation — payments match sales instantly',
            'Zero manual entry — no more copying M-Pesa messages',
            'Works with both Paybill and Till Number',
            'Real-time payment confirmation on your POS screen',
        ],
        desc: 'Accept M-Pesa payments seamlessly. Customers receive a payment prompt on their phone, pay instantly, and the transaction is automatically recorded in your sales — no manual reconciliation needed.',
    },
    {
        id: 'quotation-invoicing',
        title: 'Quotation & Invoicing Software',
        subtitle: 'Professional quotes & invoices',
        icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
        points: [
            'Generate professional quotes in seconds',
            'Convert quotes to invoices with one click',
            'Custom branding — add your logo and business details',
            'Email invoices and quotes directly to customers',
            'Track payment status — paid, pending, overdue',
        ],
        desc: 'Create stunning quotations and invoices in seconds. Whether you are quoting a new job or invoicing a repeat customer, WabePoint makes your business look professional and organized.',
    },
    {
        id: 'expense-tracking',
        title: 'Expense Tracking Software',
        subtitle: 'Monitor every shilling',
        icon: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
        points: [
            'Record every business expense — stock, rent, salaries, utilities',
            'Categorize expenses for clear financial reporting',
            'Attach receipts and notes to each expense entry',
            'See profit calculations automatically (revenue minus expenses)',
            'Export expense reports for your accountant',
        ],
        desc: 'Know exactly where your money goes. WabePoint tracks every expense from stock purchases to utility bills, giving you a clear picture of your true profitability.',
    },
    {
        id: 'debtors-creditors',
        title: 'Debtors & Creditors Tracking',
        subtitle: 'Track who owes what',
        icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
        points: [
            'Record credit sales and track who owes you',
            'Automatic reminders for overdue payments',
            'Track supplier credits and payment due dates',
            'See aging reports — 30, 60, 90 days overdue',
            'Settle debts partially or in full with payment history',
        ],
        desc: 'Never lose track of credit sales or supplier debts. WabePoint helps you manage who owes you and who you owe, with automatic reminders and clear aging reports.',
    },
]
</script>

<template>
    <Head>
        <title>{{ seo?.title || 'Point of Sale System Kenya - WabePoint POS Services' }}</title>
        <meta name="description" :content="seo?.description" />
    </Head>

    <div class="min-h-screen bg-gray-50">
        <Navigation :canLogin="true" :canRegister="true" />

        <!-- Hero -->
        <section class="relative bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] text-white overflow-hidden">
            <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 40px 40px;"></div>
            <div class="relative z-10 max-w-4xl mx-auto px-4 py-24 text-center">
                <span class="inline-block px-3 py-1 bg-[#2596be]/20 text-[#5ec4e8] text-xs font-bold uppercase tracking-widest rounded-sm mb-4 border border-[#2596be]/30">All-In-One POS System</span>
                <h1 class="text-3xl md:text-5xl font-extrabold mb-4">Everything Your Business Needs</h1>
                <p class="text-white/70 text-lg max-w-2xl mx-auto">From tax compliance to mobile payments, WabePoint gives you all the tools to run, track, and grow your business from one dashboard.</p>
            </div>
        </section>

        <!-- Services -->
        <section v-for="(svc, index) in services" :key="svc.id" :id="svc.id" class="scroll-mt-24">
            <div :class="['py-16 lg:py-20', index % 2 === 0 ? 'bg-white' : 'bg-gray-50']">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div :class="index % 2 === 0 ? 'md:order-1' : 'md:order-2'">
                            <span class="inline-block px-3 py-1 bg-[#2596be]/10 text-[#2596be] text-xs font-bold uppercase tracking-widest rounded-sm mb-3 border border-[#2596be]/20">{{ svc.subtitle }}</span>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ svc.title }}</h2>
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ svc.desc }}</p>
                            <ul class="space-y-3">
                                <li v-for="(point, i) in svc.points" :key="i" class="flex items-start gap-3 text-sm text-gray-600">
                                    <svg class="w-5 h-5 text-[#2596be] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ point }}</span>
                                </li>
                            </ul>
                        </div>
                        <div :class="index % 2 === 0 ? 'md:order-2' : 'md:order-1'" class="flex justify-center">
                            <div class="w-48 h-48 bg-gradient-to-br from-[#2596be]/10 to-[#2596be]/5 rounded-full flex items-center justify-center border-2 border-[#2596be]/20">
                                <svg class="w-24 h-24 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" :d="svc.icon" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-gradient-to-r from-[#2596be] to-[#1a6d8a] text-white py-16">
            <div class="max-w-3xl mx-auto px-4 text-center">
                <h2 class="text-2xl md:text-3xl font-extrabold mb-3">Ready to Get Started?</h2>
                <p class="text-white/80 mb-6">Get all these features and more with WabePoint. Setup in under 1 hour.</p>
                <a :href="`https://wa.me/254781312070?text=${encodeURIComponent('Hi, I\'m interested in WabePoint POS. I\'d like to book a demo.')}`" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center px-6 py-3 text-sm font-bold uppercase tracking-wider text-[#2596be] bg-white rounded-sm hover:bg-gray-100 transition-all">
                    Book a Free Demo
                </a>
            </div>
        </section>

        <Footer />
    </div>
</template>
