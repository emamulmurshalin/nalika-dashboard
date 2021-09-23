require('./bootstrap');

import Vue from "vue";
// import { createInertiaApp } from '@inertiajs/inertia-vue3';
// import { InertiaProgress } from '@inertiajs/progress';
//
// const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
//
// createInertiaApp({
//     title: (title) => `${title} - ${appName}`,
//     resolve: (name) => require(`./Pages/${name}.vue`),
//     setup({ el, app, props, plugin }) {
//         return createApp({ render: () => h(app, props) })
//             .use(plugin)
//             .mixin({ methods: { route } })
//             .mount(el);
//     },
// });
//
// InertiaProgress.init({ color: '#4B5563' });

Vue.component(
    'app-admin-dashboard',
    require('./Nalika/Components/Views/Dashboard/Dashboard').default
);
Vue.component(
    'app-admin-manage-slider',
    require('./Nalika/Components/Views/Slider/ManageSlider').default
);

window.Vue = require('vue').default;

const app = new Vue({
    el: "#app"
});
