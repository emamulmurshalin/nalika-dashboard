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

import Form from 'vform'
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.component(
    'app-admin-dashboard',
    require('./Nalika/Components/Views/Dashboard/Dashboard').default
);
Vue.component(
    'app-admin-manage-slider',
    require('./Nalika/Components/Views/Slider/ManageSlider').default
);
Vue.component(
    'add-slider-modal',
    require('./Nalika/Components/Views/Slider/AddSliderInfoModal').default
);

window.Vue = require('vue').default;
window.Form = Form;
window.$this = Vue.use(VueToast, {
    // One of the options
    position: 'top-right',
    duration: 1000
})
Vue.use(VueAxios, axios);

const app = new Vue({
    el: "#app"
});
