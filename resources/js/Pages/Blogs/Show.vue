<template>
  <div class="min-h-screen bg-gray-50">
    <Head>
        <title>{{ seo?.title || blog.name + ' - WabePoint Blog' }}</title>
        <meta name="description" :content="seo?.description" />
        <meta name="keywords" :content="seo?.keywords" />
        <link v-if="seo?.canonical" rel="canonical" :href="seo.canonical" />
        <meta v-if="seo?.type" :property="'og:type'" :content="seo.type" />
    </Head>

    <Navigation :canLogin="true" :canRegister="true" />

    <!-- Breadcrumbs -->
    <div class="bg-white border-b border-gray-200">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
          <Link href="/" class="hover:text-[#2596be] transition-colors">Home</Link>
          <span>/</span>
          <Link href="/news" class="hover:text-[#2596be] transition-colors">Blog</Link>
          <span>/</span>
          <span class="text-gray-800 font-medium truncate">{{ blog.name }}</span>
        </nav>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Article -->
        <div class="lg:col-span-2">
          <article class="bg-white rounded-sm border border-gray-200 overflow-hidden">
            <img v-if="imageUrl" :src="imageUrl" :alt="blog.name" class="w-full h-64 sm:h-80 object-cover" />

            <div class="p-6 sm:p-8">
              <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                <span class="flex items-center gap-1.5">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  {{ blog.user?.name || 'Admin' }}
                </span>
                <span class="flex items-center gap-1.5">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  {{ formatDate(blog.created_at) }}
                </span>
                <span v-if="blog.category" class="inline-flex items-center px-2.5 py-0.5 rounded-sm text-xs font-medium bg-[#2596be]/10 text-[#2596be]">
                  {{ blog.category.category_name }}
                </span>
              </div>

              <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6">{{ blog.name }}</h1>

              <div class="prose prose-gray max-w-none" v-html="blog.description"></div>

              <!-- Share -->
              <div class="mt-8 pt-6 border-t border-gray-200 flex items-center gap-3">
                <span class="text-sm font-semibold text-gray-700">Share:</span>
                <button @click="shareToPlatform('facebook')" class="p-2 text-gray-500 hover:text-[#2596be] hover:bg-gray-100 rounded-sm transition-colors">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </button>
                <button @click="shareToPlatform('twitter')" class="p-2 text-gray-500 hover:text-[#2596be] hover:bg-gray-100 rounded-sm transition-colors">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </button>
                <button @click="shareToPlatform('whatsapp')" class="p-2 text-gray-500 hover:text-[#2596be] hover:bg-gray-100 rounded-sm transition-colors">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zM12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.952 11.952 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.386 0-4.592-.828-6.328-2.208l-.44-.352-3.24 1.085 1.085-3.24-.352-.44A9.958 9.958 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10-10 10z"/></svg>
                </button>
                <button @click="copyLinkToClipboard" class="p-2 text-gray-500 hover:text-[#2596be] hover:bg-gray-100 rounded-sm transition-colors">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </button>
              </div>
            </div>
          </article>

          <!-- Prev / Next -->
          <div v-if="previous || next" class="grid grid-cols-2 gap-4 mt-8">
            <div v-if="previous" class="text-left">
              <Link :href="route('blogs.show', previous.slug)" class="group block p-4 bg-white border border-gray-200 rounded-sm hover:border-[#2596be]/30 transition-colors">
                <span class="text-xs font-bold uppercase tracking-wider text-[#2596be]">&larr; Previous</span>
                <p class="mt-1 text-sm font-medium text-gray-700 group-hover:text-[#2596be] transition-colors line-clamp-2">{{ previous.name }}</p>
              </Link>
            </div>
            <div v-if="next" class="text-right col-start-2">
              <Link :href="route('blogs.show', next.slug)" class="group block p-4 bg-white border border-gray-200 rounded-sm hover:border-[#2596be]/30 transition-colors">
                <span class="text-xs font-bold uppercase tracking-wider text-[#2596be]">Next &rarr;</span>
                <p class="mt-1 text-sm font-medium text-gray-700 group-hover:text-[#2596be] transition-colors line-clamp-2">{{ next.name }}</p>
              </Link>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
          <!-- Related Posts -->
          <div class="bg-white rounded-sm border border-gray-200 p-6">
            <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-4">Related Posts</h3>
            <div v-if="reorderedRelatedPosts.length" class="space-y-4">
              <div v-for="post in reorderedRelatedPosts" :key="post.id">
                <Link :href="route('blogs.show', post.slug)" class="group flex gap-3">
                  <img v-if="getImageUrl(post.image)" :src="getImageUrl(post.image)" :alt="post.name" class="w-20 h-16 object-cover rounded-sm flex-shrink-0" />
                  <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-medium text-gray-700 group-hover:text-[#2596be] transition-colors line-clamp-2">{{ post.name }}</h4>
                    <p class="text-xs text-gray-400 mt-1">{{ formatDateShort(post.created_at) }}</p>
                  </div>
                </Link>
              </div>
            </div>
            <p v-else class="text-sm text-gray-400">No related posts yet.</p>
          </div>

          <!-- CTA -->
          <div class="bg-gradient-to-br from-[#1a3a4a] via-[#1e4d64] to-[#1a3a4a] rounded-sm p-6 text-white">
            <h3 class="text-sm font-bold uppercase tracking-wider text-white/80 mb-2">Get WabePoint</h3>
            <p class="text-sm text-white/70 mb-4">The all-in-one POS system for Kenyan businesses.</p>
            <a :href="`https://wa.me/254781312070?text=${encodeURIComponent('Hi, I\'m interested in WabePoint POS. I\'d like to book a demo.')}`" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center px-4 py-2 text-xs font-bold uppercase tracking-wider text-[#1a3a4a] bg-white rounded-sm hover:bg-gray-100 transition-colors">
              Book a Demo
            </a>
          </div>
        </div>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'

export default {
  props: {
    blog: { type: Object, required: true },
    seo: { type: Object, default: () => ({}) },
    previous: { type: Object, default: null },
    next: { type: Object, default: null },
    blogPosts: { type: Array, default: () => [] },
    url: { type: String, default: '' },
  },
  components: { Head, Link, Navigation, Footer },
  data() {
    return { email: '' }
  },
  computed: {
    imageUrl() {
      return this.getImageUrl(this.blog.image);
    },
    relatedPosts() {
      return (this.blogPosts || []).filter(post => post.id !== this.blog.id);
    },
    reorderedRelatedPosts() {
      if (!this.relatedPosts.length) return [];
      const arr = [...this.relatedPosts];
      arr.unshift(arr.pop());
      return arr;
    }
  },
  methods: {
    getImageUrl(image) {
      if (!image) return null;
      if (image.startsWith("http")) return image;
      return `https://app.wabepoint.com/${image.startsWith("/") ? "" : "/"}${image}`;
    },
    shareToPlatform(platform) {
      const url = encodeURIComponent(this.url);
      const title = encodeURIComponent(this.blog.name);
      let shareUrl = "";
      if (platform === "facebook") {
        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${title}`;
      } else if (platform === "twitter") {
        shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
      } else if (platform === "whatsapp") {
        shareUrl = `https://wa.me/?text=${title}%20${url}`;
      }
      if (shareUrl) window.open(shareUrl, "_blank");
    },
    copyLinkToClipboard() {
      navigator.clipboard.writeText(this.url).then(() => {
        alert("Link copied to clipboard!");
      });
    },
    formatDate(date) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(date).toLocaleDateString(undefined, options);
    },
    formatDateShort(date) {
      const options = { month: "short", day: "numeric" };
      return new Date(date).toLocaleDateString(undefined, options);
    },
  },
};
</script>
