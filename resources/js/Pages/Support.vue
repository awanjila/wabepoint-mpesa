<script setup>
import { Head } from '@inertiajs/vue3'
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'

defineProps({ seo: Object })
</script>

<template>
    <Head>
        <title>{{ seo?.title || 'Support - WabePoint POS' }}</title>
        <meta name="description" :content="seo?.description" />
    </Head>

    <div class="min-h-screen bg-gray-50">
        <Navigation :canLogin="true" :canRegister="true" />

        <section class="relative bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] text-white py-20">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h1 class="text-3xl md:text-4xl font-extrabold">Support Contacts</h1>
                <p class="mt-3 text-white/70 text-lg">We're here to help</p>
            </div>
        </section>

        <section class="py-16">
            <div class="max-w-4xl mx-auto px-4 grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-sm p-6 border border-gray-200 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-[#2596be]/10 rounded-sm flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wide">Phone</h3>
                    <a href="tel:+254710909198" class="mt-2 text-[#2596be] hover:underline block">+254 710 909 198</a>
                </div>

                <div class="bg-white rounded-sm p-6 border border-gray-200 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-[#2596be]/10 rounded-sm flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#2596be]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wide">Email</h3>
                    <a href="mailto:support@wabepoint.com" class="mt-2 text-[#2596be] hover:underline block">support@wabepoint.com</a>
                </div>

                <div class="bg-white rounded-sm p-6 border border-gray-200 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 bg-[#25D366]/10 rounded-sm flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.952 11.952 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.386 0-4.592-.828-6.328-2.208l-.44-.352-3.24 1.085 1.085-3.24-.352-.44A9.958 9.958 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-sm uppercase tracking-wide">WhatsApp</h3>
                    <a href="https://wa.me/254781312070?text=Hi%2C%20I%20need%20support%20with%20WabePoint" target="_blank" class="mt-2 text-[#25D366] hover:underline block">Chat on WhatsApp</a>
                </div>
            </div>
        </section>

        <Footer />
    </div>
</template>
