<style scoped>
/* Corporate Theme - Sky Blue & Navy Blue */
:root {
  --primary-navy: #1e3a8a;
  --secondary-navy: #1e40af;
  --light-navy: #3b82f6;
  --sky-blue: #0ea5e9;
  --light-sky: #38bdf8;
  --pale-sky: #e0f2fe;
  --white: #ffffff;
  --light-gray: #f8fafc;
  --medium-gray: #64748b;
  --dark-gray: #334155;
  --border-color: #e2e8f0;
  --shadow-light: 0 1px 3px rgba(0, 0, 0, 0.1);
  --shadow-medium: 0 4px 6px rgba(0, 0, 0, 0.1);
  --shadow-strong: 0 10px 25px rgba(0, 0, 0, 0.15);
  --gradient-primary: linear-gradient(135deg, var(--primary-navy), var(--secondary-navy));
  --gradient-sky: linear-gradient(135deg, var(--sky-blue), var(--light-sky));
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: var(--dark-gray);
  background: linear-gradient(135deg, var(--pale-sky) 0%, var(--white) 100%);
  min-height: 100vh;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* YouTube-style Layout */
.youtube-layout {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/* Hero Section - Takes up most viewport */
.hero-section {
  flex: 1;
  padding: 40px 0;
  background: var(--white);
  box-shadow: var(--shadow-light);
  position: relative;
}

.hero-content {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 40px;
  align-items: start;
  position: relative;
}

/* Main Content Area */
.main-content {
  background: var(--white);
  border-radius: 16px;
  box-shadow: var(--shadow-strong);
  overflow: hidden;
  border: 1px solid var(--border-color);
  position: relative;
}

/* Featured Media */
.featured-media {
  position: relative;
  width: 100%;
  height: 450px;
  overflow: hidden;
  background: var(--gradient-primary);
}

.hero-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
  border-radius: 0;
}

.hero-image:hover {
  transform: scale(1.02);
}

/* Content Header */
.content-header {
  padding: 30px 40px 20px;
  border-bottom: 3px solid var(--sky-blue);
  background: linear-gradient(135deg, var(--white) 0%, var(--pale-sky) 100%);
  position: relative;
}

.content-header::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: var(--gradient-sky);
}

.video-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--primary-navy);
  margin-bottom: 20px;
  line-height: 1.2;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Meta Info */
.content-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 20px;
}

.author-info {
  display: flex;
  align-items: center;
  gap: 15px;
}

.author-avatar {
  position: relative;
}

.avatar-circle {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: var(--gradient-sky);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  color: var(--white);
  font-size: 1.2rem;
  box-shadow: var(--shadow-medium);
  border: 3px solid var(--white);
}

.author-details {
  display: flex;
  flex-direction: column;
}

.author-name {
  font-weight: 600;
  color: var(--primary-navy);
  font-size: 1.1rem;
}

.publish-date {
  color: var(--medium-gray);
  font-size: 0.9rem;
}

/* Action Buttons - Corporate Style */
.action-buttons {
  display: flex;
  gap: 12px;
  align-items: center;
}

.action-btn {
  width: 45px;
  height: 45px;
  border-radius: 12px;
  border: 2px solid var(--sky-blue);
  background: var(--white);
  color: var(--sky-blue);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-light);
  position: relative;
  overflow: hidden;
}

.action-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: var(--gradient-sky);
  transition: left 0.3s ease;
  z-index: 1;
}

.action-btn i {
  position: relative;
  z-index: 2;
  transition: color 0.3s ease;
}

.action-btn:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-strong);
  border-color: var(--primary-navy);
}

.action-btn:hover::before {
  left: 0;
}

.action-btn:hover i {
  color: var(--white);
}

.action-btn:active {
  transform: translateY(0);
}

/* Main Article Content */
.main-article {
  padding: 40px;
}

.article-content {
  font-size: 1.1rem;
  line-height: 1.8;
  color: var(--dark-gray);
  margin-bottom: 40px;
}

.article-content h1, .article-content h2, .article-content h3 {
  color: var(--primary-navy);
  margin: 30px 0 20px;
  font-weight: 600;
}

.article-content p {
  margin-bottom: 20px;
}

.article-content a {
  color: var(--sky-blue);
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.article-content a:hover {
  color: var(--primary-navy);
  text-decoration: underline;
}

/* Content Navigation */
.content-navigation {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
  margin-top: 40px;
  padding-top: 30px;
  border-top: 2px solid var(--pale-sky);
}

.nav-item {
  background: var(--light-gray);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: var(--shadow-light);
  transition: all 0.3s ease;
}

.nav-item:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-medium);
}

.nav-link {
  display: block;
  padding: 20px;
  text-decoration: none;
  color: var(--dark-gray);
  transition: all 0.3s ease;
}

.nav-link.prev {
  text-align: left;
  background: linear-gradient(135deg, var(--pale-sky), var(--light-gray));
}

.nav-link.next {
  text-align: right;
  background: linear-gradient(135deg, var(--light-gray), var(--pale-sky));
}

.nav-direction {
  display: block;
  font-size: 0.9rem;
  color: var(--sky-blue);
  font-weight: 600;
  margin-bottom: 8px;
}

.nav-title {
  display: block;
  font-size: 1.1rem;
  color: var(--primary-navy);
  font-weight: 500;
  line-height: 1.4;
}

/* Sidebar Section - Scrollable */
.sidebar-section {
  display: flex;
  flex-direction: column;
  gap: 30px;
  height: fit-content;
  position: sticky;
  top: 20px;
  max-height: calc(100vh - 40px);
  overflow-y: auto;
  padding-right: 10px;
}

/* Custom Scrollbar for Sidebar */
.sidebar-section::-webkit-scrollbar {
  width: 6px;
}

.sidebar-section::-webkit-scrollbar-track {
  background: var(--light-gray);
  border-radius: 3px;
}

.sidebar-section::-webkit-scrollbar-thumb {
  background: var(--sky-blue);
  border-radius: 3px;
}

.sidebar-section::-webkit-scrollbar-thumb:hover {
  background: var(--primary-navy);
}

/* Related Content */
.related-content {
  background: var(--white);
  border-radius: 16px;
  padding: 30px;
  box-shadow: var(--shadow-medium);
  border: 1px solid var(--border-color);
}

.sidebar-title {
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--primary-navy);
  margin-bottom: 25px;
  padding-bottom: 15px;
  border-bottom: 2px solid var(--sky-blue);
  position: relative;
}

.sidebar-title::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 50px;
  height: 2px;
  background: var(--primary-navy);
}

.related-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.related-item {
  background: var(--light-gray);
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s ease;
  border: 1px solid var(--border-color);
}

.related-item:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-medium);
  border-color: var(--sky-blue);
}

.related-link {
  display: flex;
  text-decoration: none;
  color: inherit;
  padding: 15px;
  gap: 15px;
}

.related-thumb {
  width: 80px;
  height: 60px;
  border-radius: 8px;
  overflow: hidden;
  flex-shrink: 0;
  background: var(--gradient-primary);
}

.related-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.related-item:hover .related-thumb img {
  transform: scale(1.1);
}

.related-info {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.related-title {
  font-size: 1rem;
  font-weight: 600;
  color: var(--primary-navy);
  line-height: 1.3;
  margin-bottom: 5px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.related-meta {
  font-size: 0.85rem;
  color: var(--medium-gray);
}

/* Newsletter Section */
.newsletter-section {
  background: var(--gradient-primary);
  border-radius: 16px;
  padding: 30px;
  box-shadow: var(--shadow-strong);
  color: var(--white);
  text-align: center;
}

.newsletter-section .sidebar-title {
  color: var(--white);
  border-bottom-color: var(--light-sky);
  font-size: 1.3rem;
}

.newsletter-section .sidebar-title::after {
  background: var(--light-sky);
}

.newsletter-desc {
  margin-bottom: 25px;
  color: var(--pale-sky);
  font-size: 1rem;
}

.newsletter-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.newsletter-input {
  padding: 15px;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  background: var(--white);
  color: var(--dark-gray);
  box-shadow: var(--shadow-light);
  transition: all 0.3s ease;
}

.newsletter-input:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.3);
  transform: translateY(-1px);
}

.newsletter-input::placeholder {
  color: var(--medium-gray);
}

/* Corporate Strong Button */
.newsletter-btn {
  padding: 15px 25px;
  border: none;
  border-radius: 10px;
  background: var(--white);
  color: var(--primary-navy);
  font-size: 1rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: var(--shadow-medium);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  position: relative;
  overflow: hidden;
}

.newsletter-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: var(--gradient-sky);
  transition: left 0.3s ease;
  z-index: 1;
}

.newsletter-btn:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-strong);
}

.newsletter-btn:hover::before {
  left: 0;
}

.newsletter-btn:hover {
  color: var(--white);
}

.newsletter-btn:active {
  transform: translateY(0);
}

/* Breadcrumbs */
.breadcrumb-section {
  background: var(--light-gray);
  padding: 20px 0;
  border-top: 1px solid var(--border-color);
}

.breadcrumbs {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.9rem;
}

.breadcrumb-link {
  color: var(--sky-blue);
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.breadcrumb-link:hover {
  color: var(--primary-navy);
  text-decoration: underline;
}

.breadcrumb-sep {
  color: var(--medium-gray);
}

.breadcrumb-current {
  color: var(--dark-gray);
  font-weight: 600;
}

/* Responsive Design */
@media (max-width: 768px) {
  .hero-content {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .sidebar-section {
    position: static;
    max-height: none;
    overflow-y: visible;
  }
  
  .video-title {
    font-size: 2rem;
  }
  
  .content-header {
    padding: 20px 25px 15px;
  }
  
  .main-article {
    padding: 25px;
  }
  
  .content-meta {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }
  
  .action-buttons {
    align-self: stretch;
    justify-content: center;
  }
  
  .content-navigation {
    grid-template-columns: 1fr;
  }
  
  .featured-media {
    height: 250px;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 15px;
  }
  
  .hero-section {
    padding: 20px 0;
  }
  
  .video-title {
    font-size: 1.8rem;
  }
  
  .content-header {
    padding: 15px 20px 10px;
  }
  
  .main-article {
    padding: 20px;
  }
  
  .related-content,
  .newsletter-section {
    padding: 20px;
  }
}
</style>

<template>
  <div class="youtube-layout">
    <!-- Navigation -->
    <Navigation />

    <!-- Hero Image Section - Takes up most of viewport like YouTube -->
    <div class="hero-section">
      <div class="container">
        <div class="hero-content">
          <div class="main-content">
            <div class="featured-media">
              <img :src="imageUrl" :alt="blog.name" class="hero-image" />
            </div>
            
            <!-- Title section -->
            <div class="content-header">
              <h1 class="video-title">{{ blog.name }}</h1>
              
              <!-- Meta info row -->
              <div class="content-meta">
                <div class="author-info">
                  <div class="author-avatar">
                    <div class="avatar-circle">{{ blog.author.charAt(0).toUpperCase() }}</div>
                  </div>
                  <div class="author-details">
                    <div class="author-name">{{ blog.author }}</div>
                    <div class="publish-date">{{ formatDate(blog.created_at) }}</div>
                  </div>
                </div>
                
                <!-- Share buttons -->
                <div class="action-buttons">
                  <button class="action-btn" @click.prevent="shareToPlatform('facebook')" title="Share on Facebook">
                    <i class="fab fa-facebook-f"></i>
                  </button>
                  <button class="action-btn" @click.prevent="shareToPlatform('twitter')" title="Share on Twitter">
                    <i class="fab fa-twitter"></i>
                  </button>
                  <button class="action-btn" @click.prevent="shareToPlatform('whatsapp')" title="Share on WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                  </button>
                  <button class="action-btn" @click.prevent="copyLinkToClipboard" title="Copy Link">
                    <i class="fa fa-link"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Main content -->
            <div class="main-article">
              <div class="article-content" v-html="blog.description"></div>
              
              <!-- Navigation Posts -->
              <div class="content-navigation">
                <div class="nav-item" v-if="previous">
                  <a :href="`/show/blog/${previous.slug}`" class="nav-link prev">
                    <span class="nav-direction">← Previous</span>
                    <span class="nav-title">{{ previous.name }}</span>
                  </a>
                </div>
                <div class="nav-item" v-if="next">
                  <a :href="`/show/blog/${next.slug}`" class="nav-link next">
                    <span class="nav-direction">Next →</span>
                    <span class="nav-title">{{ next.name }}</span>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="sidebar-section">
            <!-- Related Posts -->
            <div class="related-content">
              <h3 class="sidebar-title">Related Posts</h3>
              <div class="related-list">
                <article
                  class="related-item"
                  v-for="post in reorderedRelatedPosts"
                  :key="post.id"
                >
                  <a :href="`/show/blog/${post.slug}`" class="related-link">
                    <div class="related-thumb">
                      <img :src="getImageUrl(post.image)" :alt="post.name" />
                    </div>
                    <div class="related-info">
                      <h4 class="related-title">{{ post.name }}</h4>
                      <div class="related-meta">
                        <span class="related-date">{{ formatDateShort(post.created_at) }}</span>
                      </div>
                    </div>
                  </a>
                </article>
              </div>
            </div>

            <!-- Newsletter -->
            <div class="newsletter-section">
              <h3 class="sidebar-title">Stay Updated</h3>
              <p class="newsletter-desc">Get our latest posts delivered to your inbox</p>
              <form class="newsletter-form" @submit.prevent="subscribeNewsletter">
                <input 
                  type="email" 
                  placeholder="Email address" 
                  v-model="email" 
                  required 
                  class="newsletter-input"
                >
                <button type="submit" class="newsletter-btn">Subscribe</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Breadcrumbs -->
    <div class="breadcrumb-section">
      <div class="container">
        <nav class="breadcrumbs">
          <a href="/" class="breadcrumb-link">Home</a>
          <span class="breadcrumb-sep">/</span>
          <a href="/news" class="breadcrumb-link">Articles</a>
          <span class="breadcrumb-sep">/</span>
          <span class="breadcrumb-current">{{ blog.name }}</span>
        </nav>
      </div>
    </div>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script>
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue'

export default {
  props: {
    blog: { type: Object, required: true },
    previous: { type: Object, required: false },
    next: { type: Object, required: false },
    blogPosts: { type: Array, required: true },
    url: { type: String, required: true },
  },
  components: { Navigation, Footer },
  data() {
    return { email: '' }
  },
  computed: {
    imageUrl() {
      return this.getImageUrl(this.blog.image);
    },
    relatedPosts() {
      return this.blogPosts.filter(post => post.id !== this.blog.id);
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
      return image.startsWith("http")
        ? image
        : `https://app.wabepoint.com/${image.startsWith("/") ? "" : "/"}${image}`;
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
      if (shareUrl) {
        window.open(shareUrl, "_blank");
      }
    },
    copyLinkToClipboard() {
      navigator.clipboard.writeText(this.url).then(() => {
        this.showNotification("Link copied to clipboard!");
      }).catch(err => {
        console.error("Failed to copy link: ", err);
      });
    },
    subscribeNewsletter() {
      this.showNotification("Thanks for subscribing!");
      this.email = '';
    },
    showNotification(message) {
      alert(message);
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
