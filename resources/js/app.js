/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import axios from "axios";
import VueAxios from "vue-axios";
import VueProgressiveImage from "vue-progressive-image";
// import { faFontAwesome } from "@fortawesome/free-brands-svg-icons";
import { library } from "@fortawesome/fontawesome-svg-core";
// import { faUserSecret } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faSpinner,
    faAlignLeft,
    faUser,
    faUpload,
    faSync,
    faBan,
    faTrash,
    faPlusSquare,
    faMobile,
    faSearch,
    faDumbbell,
    faEye,
    faEdit,
    faPlus,
    faCubes,
    faArrowLeft,
    faDownload,
    faNewspaper,
    faEnvelope,
    faPen,
    faHistory,
    faUndo,
    faComments,
    faShoppingCart,
    faHome,
    faImage,
    faColumns,
    faHotel,
    faTruckLoading,
    faIdCard,
    faLocationArrow,
    faEllipsisV
} from "@fortawesome/free-solid-svg-icons";
library.add(
    faSpinner,
    faAlignLeft,
    faUser,
    faSync,
    faUpload,
    faBan,
    faTrash,
    faEllipsisV,
    faPlusSquare,
    faMobile,
    faSearch,
    faDumbbell,
    faEye,
    faEdit,
    faPlus,
    faCubes,
    faArrowLeft,
    faDownload,
    faNewspaper,
    faEnvelope,
    faPen,
    faHistory,
    faUndo,
    faComments,
    faShoppingCart,
    faHome,
    faImage,
    faColumns,
    faHotel,
    faTruckLoading,
    faIdCard,
    faLocationArrow
);

// library.add(faUserSecret);
Vue.component("font-awesome-icon", FontAwesomeIcon);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('banner-component', require('./components/projects/Banner.vue').default);
Vue.component('gallery-component', require('./components/projects/Gallery.vue').default);
Vue.component('floorplan-component', require('./components/projects/Floorplan.vue').default);
Vue.component('views-component', require('./components/projects/Views.vue').default);
Vue.component('cuverse-upload-component', require('./components/cuVerses/cuVerseUpload.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.prototype.publicPath = '/';
Vue.prototype.$getPublicPath = function(file) {
    return file;
};

Vue.use(VueAxios, axios);
Vue.use(VueProgressiveImage, {
    cache: false
});


const app = new Vue({
    el: '#app',
});