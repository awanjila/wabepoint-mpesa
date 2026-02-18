<template>
  <div class="youtube-layout">
    <!-- Parallax Header -->
    <div class="page-title parallax parallax1">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-title-content text-center">
              <div class="breadcrumbs">
                <ul>
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Blog</a></li>
                </ul>
              </div>
              <div class="page-title-heading">
                <h2>Our Blog</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Blog Grid -->
    <div class="main-blog-grid3 pushed-down">
      <div class="container">
        <div class="blog-grid-list">
          <div v-for="item in paginatedBlogs" :key="item.slug" class="blog-card">
            <article class="post mb-mgtop0">
              <div class="post-border">
                <div class="featured-post">
                  <img :src="getImageUrl(item.image)" :alt="item.name" class="blog-banner">
                </div>
                <div class="content-post">
                  <div class="post-title">
                    <span><Link :href="'#'">{{ item.category ? item.category.category_name : 'Uncategorized' }}</Link></span>
                  </div>
                  <div class="post-content">
                    <h2><Link :href="route('blogs.show', item.slug)" class="blog-title">{{ item.name }}</Link></h2>
                  </div>
                  <div class="post-meta">
                    <span><Link :href="'#'"><time :datetime="item.created_at">{{ formatDate(item.created_at) }}</time></Link></span>
                  </div>
                  <div class="post-button">
                    <Link :href="route('blogs.show', item.slug)">READ MORE <i class="fa fa-long-arrow-right" aria-hidden="true"></i></Link>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="blog-pagination">
        <ul class="flat-pagination">
          <li class="prev" :class="{ disabled: currentPage === 1 }">
            <a @click.prevent="goToPage(currentPage - 1)" class="hvr-shutter-out-horizontal" :class="{ disabled: currentPage === 1 }">
              <i class="fa fa-angle-left" aria-hidden="true"></i>
            </a>
          </li>
          <li v-for="page in totalPages" :key="page">
            <a @click.prevent="goToPage(page)" :class="{ active: currentPage === page }" class="hvr-shutter-out-horizontal">{{ page }}</a>
          </li>
          <li class="next" :class="{ disabled: currentPage === totalPages }">
            <a @click.prevent="goToPage(currentPage + 1)" class="hvr-shutter-out-horizontal" :class="{ disabled: currentPage === totalPages }">
              <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import Navigation from '@/Components/Navigation.vue';
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
      const end = start + this.blogsPerPage;
      return this.sortedBlogs.slice(start, end);
    },
    totalPages() {
      return Math.ceil(this.sortedBlogs.length / this.blogsPerPage);
    }
  },
  methods: {
    getImageUrl(image) {
      if (!image) return '/images/default-placeholder.jpg';
      if (/^https?:\/\//.test(image)) return image;
      return `https://app.wabepoint.com/${image.replace(/^\/+/, '')}`;
    },
    formatDate(date) {
      const options = { day: '2-digit', month: 'short', year: 'numeric' };
      return new Date(date).toLocaleDateString('en-US', options);
    },
    goToPage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page;
      }
    }
  },
  components: {
    Navigation,
    Link
  },
};
</script>



<style scoped>
.youtube-layout {
  background: #fff;
  min-height: 100vh;
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

.page-title {
  padding: 40px 0;
}

.page-title-content {
  text-align: center;
  color: #fff;
}

.breadcrumbs ul {
  list-style: none;
  padding: 0;
  display: inline-block;
}

.breadcrumbs li {
  display: inline;
  margin-right: 5px;
}

.breadcrumbs a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
}

.page-title-heading h2 {
  font-size: 36px;
  margin: 0;
}

@media (max-width: 768px) {
  .page-title-heading h2 {
    font-size: 28px;
  }
}

.pushed-down {
  margin-top: 20px;
}

.blog-grid-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-top: 32px;
}

@media (max-width: 1024px) {
  .blog-grid-list {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 768px) {
  .blog-grid-list {
    grid-template-columns: 1fr;
  }
}

.blog-card {
  display: flex;
  flex-direction: column;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  transition: box-shadow 0.2s;
  overflow: hidden;
}
.blog-card:hover {
  box-shadow: 0 8px 24px rgba(0,0,0,0.10);
}

.post {
  margin-bottom: 0;
  border: none;
  border-radius: 0;
  background: none;
  overflow: visible;
  transition: none;
}

.post-border {
  padding: 0;
}

.featured-post {
  width: 100%;
  height: 200px;
  overflow: hidden;
  border-radius: 12px 12px 0 0;
  background: #f9f9f9;
}

.blog-banner {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.content-post {
  padding: 20px 18px 18px 18px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.post-title {
  font-weight: bold;
  margin-bottom: 4px;
  font-size: 13px;
  color: #606060;
}

.blog-title {
  font-size: 1.2em;
  margin-bottom: 8px;
  color: #0f0f0f;
  text-decoration: none;
  font-weight: 600;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-title:hover {
  text-decoration: underline;
  color: #065fd4;
}

.post-meta {
  font-size: 0.95em;
  color: #606060;
  margin-bottom: 6px;
}

.post-button a {
  color: #065fd4;
  text-decoration: none;
  font-weight: bold;
  font-size: 13px;
}

.post-button a:hover {
  text-decoration: underline;
}

.blog-pagination {
  text-align: center;
  margin-top: 32px;
}

.flat-pagination {
  list-style: none;
  padding: 0;
  display: inline-flex;
}

.flat-pagination li {
  margin: 0 5px;
}

.flat-pagination a {
  padding: 10px 15px;
  border: 1px solid #ddd;
  border-radius: 4px;
  text-decoration: none;
  color: #333;
  background: #fff;
  transition: background 0.15s, color 0.15s;
}

.flat-pagination a.active {
  background-color: #065fd4;
  color: white;
}

.flat-pagination a.disabled {
  pointer-events: none;
  color: #ccc;
  background: #f5f5f5;
}

@media (max-width: 480px) {
  .container {
    padding: 0 12px;
  }
  .blog-grid-list {
    gap: 12px;
  }
  .content-post {
    padding: 14px 10px 12px 10px;
  }
}
</style>
