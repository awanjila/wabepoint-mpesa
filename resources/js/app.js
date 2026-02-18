
import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Blog from './Components/Blog.vue';

const appName = import.meta.env.VITE_APP_NAME || 'WabePoint Online POS & Inventory System';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

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
