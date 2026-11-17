
import './bootstrap';
import '../css/app.css';

import { createSSRApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Blog from './Components/Blog.vue';

// A pre-rendered HTML page can be served in place of an Inertia JSON response.
// Inertia would otherwise render that HTML inside a full-screen iframe modal,
// stacking a new copy of the site on every click. Force a real page load instead.
document.addEventListener('inertia:invalid', (event) => {
    const response = event.detail?.response;
    const method = response?.config?.method?.toLowerCase();

    if (method && method !== 'get') return;

    event.preventDefault();
    const target =
        response?.headers?.get?.('X-Inertia-Location') ||
        response?.config?.url ||
        window.location.href;

    window.location.assign(target);
});

createInertiaApp({
    title: (title) => title,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createSSRApp({ render: () => h(App, props) });

        app.use(plugin)
            .use(ZiggyVue)
            .component('blog', Blog) // ✅ Register Blog globally
            .mount(el);

        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
