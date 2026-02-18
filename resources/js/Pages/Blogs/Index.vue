<template>
  <div>
    <Navigation :canLogin="canLogin" :canRegister="canRegister" />
    <Blog :blogs="blogs" />
    <Footer />
  </div>
</template>

<script>
import Blog from '@/Components/Blog.vue'
import Navigation from '@/Components/Navigation.vue'
import Footer from '@/Components/Footer.vue';

export default {
  props: {
    blogs: {
      type: Array,
      default: () => []
    },
    canLogin: {
      type: Boolean,
      default: false
    },
    canRegister: {
      type: Boolean,
      default: false
    }
  },

  components: {
    Blog,
    Navigation,
    Footer
  }
}
</script>
