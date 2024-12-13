import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { Link, createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia';
import Layout from './Layouts/Layout.vue';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) })

    const pinia = createPinia();

    app
    .use(pinia)
      .component('Layout', Layout)
      .component('Link', Link)
      .use(plugin)
      .mount(el)
  },
})
