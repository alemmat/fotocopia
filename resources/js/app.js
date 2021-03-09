require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import * as VueGoogleMaps from "vue2-google-maps";
import VueSmoothScroll from 'vue2-smooth-scroll';

import VueRouter from 'vue-router'

Vue.use(VueRouter)

Vue.use(VueSmoothScroll);


Vue.use(VueGoogleMaps, {
  load: {
    key: "AIzaSyCYxLjkd844rCYKg-Ns8coTQAvPjVL4YzM",
    libraries: "places" // necessary for places input
  }
});

Vue.use(VueMaterial);

Vue.component('menu-icon', MenuIcon);

Vue.component('landing-component', require('./components/Landing.vue').default);

Vue.component('maps-component', require('./components/Maps.vue').default);

Vue.component('archivos-component', require('./components/Archivos.vue').default);

Vue.component('archivoitem-component', require('./components/Archivoitem.vue').default);

Vue.component('cliente-component', require('./components/Cliente.vue').default);

Vue.component('imprenta-component', require('./components/Imprenta.vue').default);

Vue.component('cardbuttom-component', require('./components/CardButtom.vue').default);

const app = new Vue({
    el: '#app',
});
