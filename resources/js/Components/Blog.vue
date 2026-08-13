<template>
  <div class="bg-gray-50 min-h-screen">
    <section class="bg-gradient-to-r from-[#1a3a4a] via-[#1e4d64] to-[#2596be] py-14 sm:py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <nav class="flex items-center justify-center gap-2 text-sm text-white/70 mb-4">
          <Link href="/" class="hover:text-white transition-colors">Home</Link>
          <span>/</span>
          <span class="text-white font-medium">Blog</span>
        </nav>
        <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">Our Blog</h1>
        <p class="text-white/80 max-w-2xl mx-auto text-sm sm:text-base">
          POS and inventory management tips, business insights and industry news from WabePoint.
        </p>
      </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div v-if="sortedBlogs.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <article v-for="item in paginatedBlogs" :key="item.slug"
                 class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md border border-gray-100 transition-shadow flex flex-col">
          <Link :href="route('blogs.show', item.slug)" class="block h-48 overflow-hidden bg-gray-100">
            <img :src="getImageUrl(item.image)" :alt="item.name" class="w-full h-full object-cover" loading="lazy">
          </Link>
          <div class="p-5 flex flex-col flex-1">
            <span class="text-xs font-semibold uppercase tracking-wider text-[#2596be] mb-2">
              {{ item.category ? item.category.category_name : 'Uncategorized' }}
            </span>
            <h2 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
              <Link :href="route('blogs.show', item.slug)" class="hover:text-[#2596be] transition-colors">{{ item.name }}</Link>
            </h2>
            <div class="flex items-center gap-2 text-xs text-gray-400 mt-auto pt-3">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <time :datetime="item.created_at">{{ formatDate(item.created_at) }}</time>
              <span class="ml-auto text-[#2596be] font-semibold text-xs">Read More &rarr;</span>
            </div>
          </div>
        </article>
      </div>

      <div v-else class="text-center py-20">
        <p class="text-gray-500">No blog posts yet. Check back soon!</p>
      </div>

      <nav v-if="totalPages > 1" class="flex items-center justify-center gap-1 mt-10">
        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] disabled:opacity-40 disabled:cursor-not-allowed">
          &larr;
        </button>
        <button v-for="page in totalPages" :key="page" @click="goToPage(page)"
                :class="currentPage === page ? 'bg-[#2596be] text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                class="w-9 h-9 text-sm font-medium rounded-md border border-gray-200 transition-colors">
          {{ page }}
        </button>
        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-[#2596be] disabled:opacity-40 disabled:cursor-not-allowed">
          &rarr;
        </button>
      </nav>
    </section>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  props: {
    blogs: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      currentPage: 1,
      blogsPerPage: 6
    };
  },
  computed: {
    sortedBlogs() {
      return this.blogs.slice().sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    },
    paginatedBlogs() {
      const start = (this.currentPage - 1) * this.blogsPerPage;
      return this.sortedBlogs.slice(start, start + this.blogsPerPage);
    },
    totalPages() {
      return Math.max(1, Math.ceil(this.sortedBlogs.length / this.blogsPerPage));
    }
  },
  methods: {
    getImageUrl(image) {
      if (!image) return '/images/default-placeholder.jpg';
      if (/^https?:\/\//.test(image)) return image;
      return `/${image.replace(/^\/+/, '')}`;
    },
    formatDate(date) {
      const options = { day: '2-digit', month: 'short', year: 'numeric' };
      return new Date(date).toLocaleDateString('en-US', options);
    },
    goToPage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page;
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    }
  },
  components: {
    Link
  },
};
</script>
